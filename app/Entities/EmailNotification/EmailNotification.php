<?php

namespace App\Entities\EmailNotification;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmailNotification.
 *
 * @package namespace App\Entities\EmailNotification;
 */
class EmailNotification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'status',
        'description',
    ];

}
