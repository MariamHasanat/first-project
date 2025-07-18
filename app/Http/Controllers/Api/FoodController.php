<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return FoodResource::collection(Food::with('component')->get());
        $foods = Food::all();
        if ($foods->isEmpty()) {
            return response()->json(['message' => 'No foods found'], 404);
        }
        return response()->json(FoodResource::collection($foods));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'ingredients' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->messages()
            ], 422);
        }

        $food = Food::create($validator->validated());

        return response()->json(FoodResource::make($food), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = Food::find($id);
        if (is_null($food)) {
            return response()->json(['message' => 'Food not found']);
        }
        return FoodResource::make($food);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $food = Food::find($id);
        if (is_null($food)) {
            return response()->json(['message' => 'Food not found']);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'ingredients' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->messages()
            ], 422);
        }
        $food->update($validator->validated());
        return response()->json(FoodResource::make($food));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::find($id);
        if (is_null($food)) {
            return response()->json(['message' => 'Food not found']);
        }
        $food->delete();
        return response()->json(['message' => 'Food deleted']);
    }
}
