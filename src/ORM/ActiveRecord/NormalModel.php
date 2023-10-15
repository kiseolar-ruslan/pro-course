<?php

namespace App\ORM\ActiveRecord;

use App\ORM\ActiveRecord\Traits\NormalObjectBehavior;
use Illuminate\Database\Eloquent\Model;

abstract class NormalModel extends Model
{
    use NormalObjectBehavior;
}