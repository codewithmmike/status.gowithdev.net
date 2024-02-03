<?php

namespace App\Models;

class Country extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'flag',
        'local_flag',

        // extended fields
        'sync_count',
    ];

    public static function getListOfNameIds(): array
    {
        $list = [];
        $items = self::select('name', 'id')->orderBy('id', 'asc')->get();
        foreach ($items as $item) {
            $list[$item->name] = $item->id;
        }

        return $list;
    }

}
