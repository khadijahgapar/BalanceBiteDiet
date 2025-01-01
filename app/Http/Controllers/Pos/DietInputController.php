<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLevel;
use App\Models\Diet;

class DietInputController extends Controller
{
    /**
     * Display the form for user input.
     */
    public function index()
    {
        // Fetch activity levels to populate the dropdown
        $activityLevels = ActivityLevel::all();
        return view('index', compact('activityLevels'));
    }

    /**
     * Store the user input data.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'weight' => 'required|numeric|min:30|max:200',
            'height' => 'required|numeric|min:100|max:250',
            'activity_level_id' => 'required|exists:activity_levels,id',
            'dietary_preference' => 'required|string|max:50',
            'medical_condition' => 'nullable|string|max:100',
            'goal' => 'required|string|max:50',
            'category_food_set' => 'required|in:casual,moderate,intensive',
            'set_food' => 'required|array',
            'calories' => 'required|integer|max:10000',
        ]);

        // Store the data in the database
        Diet::create([
            'weight' => $request->weight,
            'height' => $request->height,
            'activity_level_id' => $request->activity_level_id,
            'dietary_preference' => $request->dietary_preference,
            'medical_condition' => $request->medical_condition,
            'goal' => $request->goal,
            'category_food_set' => $request->category_food_set,
            'set_food' => json_encode($request->set_food),
            'calories' => $request->calories,
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Data submitted successfully!');
    }
}
