<?php

namespace App\Repositories\EmailNotification;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\EmailNotification\EmailNotification;

/**
 * Class EmailNotificationRepositoryEloquent.
 *
 * @package namespace App\Repositories\EmailNotification;
 */
class EmailNotificationRepositoryEloquent extends BaseRepository implements EmailNotificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return EmailNotification::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
