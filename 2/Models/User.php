<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'middle_name'];

    const VALIDATION_RULES_FOR_CREATE_OR_UPDATE_METHOD = [
        'first_name' => 'string|required',
        'middle_name' => 'string|required',
        'last_name' => 'string|required',
        'phones' => 'array|nullable',
        'phones.*' => 'integer'
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public static function getValidationRulesForMethod($method = 'create')
    {
        if ($method === 'create' || $method === 'update')
            return self::VALIDATION_RULES_FOR_CREATE_OR_UPDATE_METHOD;
        else return [];
    }
}