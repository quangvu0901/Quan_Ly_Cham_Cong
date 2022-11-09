<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\StringCast;
use App\Casts\BooleanCast;

class TimekeepRule extends Model
{
    use HasFactory;

    protected $table = 'timekeep_rules';

    protected $fillable = ["name", "type", "value", "default","active", "status"];

    public static $listFields = ["id", "name", "type", "value", "active", "status", "created_at", "updated_at"];

    protected $casts = [
        "name" => StringCast::class,
		"type" => StringCast::class,
		"active" => BooleanCast::class,
		"status" => BooleanCast::class,

    ];
}
