<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function inventory(){
        return $this->belongsTo(Inventory::class,'inventory_id','id');
        return $this->hasMany(Inventory::class, 'inventory_id', 'id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'employee_id','id');
        
    }
}
