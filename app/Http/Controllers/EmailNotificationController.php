<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Repositories\EmailNotification\EmailNotificationRepository;
use Inertia\Inertia;
use Inertia\Response;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class EmailNotificationController extends Controller
{
   /**
     * @param EmailNotificationRepository $emailNotificationRepository
     */
    public function __construct(
        protected EmailNotificationRepository $emailNotificationRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('email');
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

        return $this->emailNotificationRepository->create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return response()->json($this->emailNotificationRepository->all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailNotification $emailNotification)
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

        return $this->emailNotificationRepository->delete($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request['id'];
        //... Validation here
        $this->emailNotificationRepository->update([
            'email' => $request['email'],
            'status' => $request['status'],
            'description' => $request['description'],
        ], $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailNotification $emailNotification)
    {
        //
    }

    /**
     * Send email notification
     */

    public function sendEmail()
    {
        $userEmailList = $this->emailNotificationRepository->all();
        foreach ($userEmailList as $key => $value) {
            Mail::to($value->email)->send(new SendMail());
        }      
    }
}
