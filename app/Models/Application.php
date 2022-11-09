<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\StringCast;
use App\Casts\BooleanCast;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = ["name", "salary_rate", "day_off", "note", "status"];

    public static $listFields = ["id", "name", "salary_rate", "day_off", "note", "status", "created_at", "updated_at"];

    protected $casts = [
        "name" => StringCast::class,
		"salary_rate" => StringCast::class,
		"day_off" => StringCast::class,
		"status" => BooleanCast::class,
		
    ];
}
