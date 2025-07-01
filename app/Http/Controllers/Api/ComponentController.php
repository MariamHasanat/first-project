<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComponentResource;
use Illuminate\Http\Request;
use App\Models\Component;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ComponentResource::collection(Component::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $component = Component::create($validated);
        return response()->json(ComponentResource::make($component), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $component = Component::findOrFail($id);
        return ComponentResource::make($component);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $component = Component::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $component->update($validated);
        return response()->json(ComponentResource::make($component));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $component = Component::findOrFail($id);
        $component->delete();
        return response()->json(['message' => 'Component deleted']);
    }
}
