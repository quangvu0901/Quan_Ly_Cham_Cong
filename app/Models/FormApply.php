<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\IntegerCast;
use App\Casts\StringCast;

class FormApply extends Model
{
    use HasFactory;

    protected $table = 'form_applies';

    protected $fillable = ["user_id", "apply_id","company_id","department_id", "creator", "sensor", "from", "to", "reason", "status"];

    public static $listFields = ["id", "user_id","company_id","department_id", "apply_id", "creator", "sensor", "from", "to", "reason", "status", "created_at", "updated_at"];

    protected $casts = [
        "user_id" => IntegerCast::class,
		"apply_id" => StringCast::class,
		"creator" => StringCast::class,
		"sensor" => StringCast::class,
		"status" => IntegerCast::class,

    ];

    public function formApply(){
        return $this->belongsTo(Application::class,"apply_id","id");
    }
    public function companies(){
        return $this->belongsTo(Company::class,"company_id","id");
    }
    public function departments(){
        return $this->belongsTo(Department::class,"department_id","id");
    }
}
