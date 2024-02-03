<?php

namespace App\Services;

use App\Repositories\EmailNotification\EmailNotificationRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;
use Symfony\Component\Routing\Annotation\Route;

class EmailNotificationService
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
     * Get list of Jobs
     *
     * @return mixed
     */
    public function getListEmailNotification(): mixed
    {
        die("ửetyuiop");
        // return "OKKKK";
    }
}
