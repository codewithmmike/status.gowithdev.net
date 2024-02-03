<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\Domain\DomainRepository;

class EmailNotificationBody extends Component
{
    public $listdomain;
    /**
     * @param DomainRepository $domainRepository
     */
    public function __construct(
        public DomainRepository $domainRepository
    )
    {
        $listdomain = $this->domainRepository->all();
    }

    public function render()
    {
        return view('livewire.email-notification-body');
    }
}
