<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const GENDER_MALE = 'pria';
    const GENDER_FEMALE = 'wanita';
    const GENDER = [self::GENDER_MALE, self::GENDER_FEMALE];
}
