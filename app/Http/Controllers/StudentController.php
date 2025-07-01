<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Logic to display a list of students
        // This could involve fetching students from the database and returning a view
        // For example:

        $students = Student::with('courses')->get();

        return response()->json(StudentResource::collection($students), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show the form for creating a new student
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ],422);
        }

        $data = $validator->validated();
        // $file = $request->file('file');

        // $student = Student::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'phone' => $data['phone'],
        //     'date_of_birth' => $data['date_of_birth'],
        //     'address' => $data['address'],
        // ]);

        $list = Student::create($data);


        if ($list) {
            return response()->json(['message' => 'Student created successfully', 'data' => $list], 201);
        } else {
            return response()->json(['message' => 'Failed to create student'], 500);
        }
        // Logic to store a new student
        // $student = new Student();
        // $student->name = $request->input('name');
        // $student->email = $request->input('email');
        // $student->phone = $request->input('phone');
        // $student->date_of_birth = $request->input('date_of_birth');
        // $student->address = $request->input('address');
        // $student->save();
        // return response()->json($student, 200);
        // // ----------------------------
        // $list = Student::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'date_of_birth' => $request->date_of_birth,
        //     'address' => $request->address,
        // ]);

      
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Logic to display a specific student
        $student = Student::find($id);
        if ($student) {
            return response()->json(['message' => 'Student found', 'data' => $student], 200);
        } else {
            return response()->json(['message' => 'Student not found', 'data' => null], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) // update
    {
        // Logic to show the form for editing a specific student
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

          $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ],422);
        }

        $data = $validator->validated();
        // Logic to update a specific student
        $student = Student::find($id);
        
        if ($student) {
            $student->update($data);
            return response()->json(['message' => 'Student updated successfully', 'data' => $student], 200);
        } else {
            return response()->json(['message' => 'Student not found', 'data' => null], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete a specific student
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student not found', 'data' => null], 404);
        }
    }
}
