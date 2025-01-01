<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'height',
        'activity_level_id',
        'dietary_preference',
        'medical_condition',
        'goal',
        'category_food_set',
        'set_food',
        'calories',
    ];

    protected $casts = [
        'set_food' => 'array',
    ];

    public function activityLevel()
    {
        return $this->belongsTo(ActivityLevel::class);
    }
}
