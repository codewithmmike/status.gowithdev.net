<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\Domain\DomainRepository;
use Illuminate\Http\Request;

class EmailNotificationBody extends Component
{
    public $listdomain;
    public $user;
    public function mount(DomainRepository $domainRepository, Request $request)
    {
        $this->listdomain = $domainRepository->all()->where('status', 'DIE');
        $this->user = $request->user();
    }

    public function render()
    {
        return view('livewire.email-notification-body');
    }
}
