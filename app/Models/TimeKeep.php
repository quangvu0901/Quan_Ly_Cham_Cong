<?php

namespace App\Models;

use App\Casts\NumberCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeKeep extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "note", "punish", "count"];

    public static $listFields = ["id", "user_id", "note", "punish", "count", "created_at", "updated_at"];
    public $timestamps = true;

    
    protected $casts = [
        "user_id" => NumberCast::class,
    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
