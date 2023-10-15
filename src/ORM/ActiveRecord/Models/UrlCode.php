<?php

declare(strict_types=1);

namespace App\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UrlCode extends Model
{
    protected $table = 'url_codes';
//
//    protected $fillable = [
//        "id",
//        "code",
//        "url"
//    ];

    public $timestamps = false;
}