<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repositories\Domain\DomainRepository;

class Domain extends BaseModel
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'type',
        'status',
        'http_code',
        'http_message',
        'description',
        'user_id',
        'deleted_at',
    ];

    public static function CheckStatus(): bool
    {
        $listdomain = self::all();
        foreach ($listdomain as $key => $value){
            if ($value->deleted_at == null) {
                $ch = curl_init($value->name);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $has3w = (strpos(curl_getinfo($ch, CURLINFO_REDIRECT_URL), 'www.') !== false) ? 'Support WWW': 'Not support WWW';
                curl_close($ch);
                if (in_array($httpCode, [0, 500, 404])) {
                    // Trạng thái 500 - Update status Domain là DIE
                    $value->update([
                        'status' => 'DIE',
                        'http_code' => $httpCode,
                        'http_message' => $has3w,
                    ]);
                } else {
                    // Trạng thái không phải 500 - Update status Domain là LIVE
                    $value->update([
                        'status' => 'LIVE',
                        'http_code' => $httpCode,
                        'http_message' => $has3w,
                    ]);
                } 
            }         
        }
        return true;
    }
}



