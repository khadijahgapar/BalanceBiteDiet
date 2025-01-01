<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function keyboards(){
        return $this->hasMany(Keyboard::class, 'inventory_id', 'id');
        return $this->belongsTo(Keyboard::class,'inventory_id','id');
    }

    public function mice(){
        return $this->hasMany(Mouse::class, 'inventory_id', 'id');
        
    }

    public function monitors(){
        return $this->hasMany(Monitor::class, 'inventory_id', 'id');
        
    }

    public function pcs(){
        return $this->hasMany(Pc::class, 'inventory_id', 'id');
        
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    /*public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }*/

    public function user(){
        return $this->belongsTo(User::class,'employee_id','id');
        
    }
}
