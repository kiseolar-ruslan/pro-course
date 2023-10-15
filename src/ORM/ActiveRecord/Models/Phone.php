<?php

declare(strict_types=1);

namespace App\ORM\ActiveRecord\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';

    protected $fillable = [
        "id",
        "user_id",
        "phone"
    ];

    public $timestamps = false;

    public static function createPhone(User $user, string $phone)
    {
        return Phone::create([
                                 "phone"   => $phone,
                                 "user_id" => $user,
                             ]);
    }
}