<?php

declare(strict_types=1);

namespace App\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Model;

class UrlCode extends Model
{
    protected $table = 'url_codes';

    protected $fillable = [
        "id",
        "code",
        "url"
    ];

    public $timestamps = false;
}