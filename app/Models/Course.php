<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
    ];
    // protected $guarded = [];
    protected $table = 'courses';
    public $timestamps = true;  
    /**
     * The students that belong to the course.
     */
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }



    
    // This method defines a many-to-many relationship between Course and Student models
    // It uses the 'course_student' pivot table to manage the relationship
    // The 'belongsToMany' method indicates that a course can have many students and a student can belong to many courses
    // The 'Student' model should be defined in the same namespace or imported at the top
    // The 'course_student' table is used to link courses and students
    // This allows for efficient querying of students enrolled in a course and courses a student is enrolled
    // in, leveraging the pivot table for many-to-many relationships
    // This method can be used to retrieve all students enrolled in a specific course   
    // and can be called on a Course instance like $course->students
    // It returns a collection of Student models associated with the course 

}
