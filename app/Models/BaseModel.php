<?php

namespace App\Models;

use App\ValidationRules\BaseRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory;
    //static protected BaseRules $rules;

    public static function createInModel(array $attributes)
    {

    }
}
