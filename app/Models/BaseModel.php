<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    const API_IGNORE_FIELDS = ['sync_count', 'hash_code'];
    const SYNC_BATCH_SIZE = 1000;
}
