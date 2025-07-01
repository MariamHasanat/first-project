<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Logic to display a list of courses
        // This could involve fetching courses from the database and returning a view
        // For example:
        $courses = Course::with('students')->get();
        return response()->json(CourseResource::collection($courses), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show the form for creating a new course
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store a new course in the database
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:courses',
        ]);


        $course = Course::create($validatedData);
        return response()->json(CourseResource::make($course), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        // Logic to show the form for editing a course
        // This could involve fetching the course from the database and returning a view
        return response()->json($course);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        // Logic to update a course in the database
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:courses,title,' . $course->id,
        ]);

        $course->update($validatedData);
        return response()->json($course);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Logic to delete a course from the database
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully'], 204);
    }
    /**
     * Enroll a student in a course.
     */
    public function enrollStudent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $course = Course::findOrFail($id);
        $course->students()->attach($validatedData['student_id']);
        return response()->json(['message' => 'Student enrolled successfully'], 200);
    }
}
