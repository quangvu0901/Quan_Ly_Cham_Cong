<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ["name", "company_id", "parent_id", "root_id"];

    public static $listFields = ["id", "name", "company_id", "parent_id", "root_id", "created_at", "updated_at"];

    protected $casts = [
        
    ];
    
    public function company(){
        return $this->belongsTo(Company::class,"company_id","id");
    }
    public function parent(){
        return $this->belongsTo(Department::class,"parent_id","id");
    }
    public function children(){
        return $this->hasMany(Department::class,"parent_id","id");
    }
}
