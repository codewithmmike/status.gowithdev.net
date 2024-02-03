<?php

namespace App\Repositories\Domain;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Domain;

/**
 * Class DomainRepositoryEloquent.
 *
 * @package namespace App\Repositories\Domain;
 */
class DomainRepositoryEloquent extends BaseRepository implements DomainRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Domain::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
