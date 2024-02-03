<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Repositories\Domain\DomainRepository;
use App\Repositories\EmailNotification\EmailNotificationRepository;
use Inertia\Inertia;
use Inertia\Response;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Filament\Resources\UserResource\Pages;
use Filament\Filament;

class DomainController extends Controller
{
   /**
     * @param DomainRepository $domainRepository
     * @param EmailNotificationRepository $emailNotificationRepository
     */
    public function __construct(
        protected DomainRepository $domainRepository,
        protected EmailNotificationRepository $emailNotificationRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('domain');
    }

    /**
     * checkStatus.
     */
    public function checkStatus()
    {
        $listdomain = $this->domainRepository->all();
        foreach ($listdomain as $key => $value){
            $ch = curl_init($value->name);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($httpCode == 200) {
                // Trạng thái 200 OK - Update status Domain là LIVE
                $this->domainRepository->update([
                    'status' => 'LIVE'
                ], $value->id);
            } else {
                // Trạng thái không phải 200 - Update status Domain là DIE
                $this->domainRepository->update([
                    'status' => 'DIE'
                ], $value->id);
            }          
        }
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //... Validation here

        return $this->domainRepository->create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return response()->json($this->domainRepository->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $data = $request['id'];
        //... Validation here

        return $this->domainRepository->delete($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request['id'];
        //... Validation here
        $this->domainRepository->update([
            'name' => $request['name'],
            'type' => $request['type'],
            'status' => $request['status'],
            'description' => $request['description'],
        ], $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {
        //
    }
}
