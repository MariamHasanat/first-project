Here are the steps to create a table, model, controller, and build an API endpoint in Laravel:

---

### 1. Create a Migration (Table)
Run this command to create a migration for a `students` table:
```
php artisan make:migration create_students_table --create=students
```
Edit the generated migration file in migrations to define your columns, for example:
```php
public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamps();
    });
}
```

---

### 2. Run the Migration
Apply the migration to create the table:
```
php artisan migrate
```

---

### 3. Create a Model
Generate a model for the `students` table:
```
php artisan make:model Student
```

---

### 4. Create a Controller
Generate a controller for your API:
```
php artisan make:controller StudentController
```

---

### 5. Build an Endpoint in the Controller
Open StudentController.php and add a method:
```php
use App\Models\Student;

public function index()
{
    return response()->json(Student::all());
}
```

---

### 6. Declare the Endpoint in Routes
Open api.php and add:
```php
use App\Http\Controllers\StudentController;

Route::get('students', [StudentController::class, 'index']);
```

---

Now, you can access your endpoint at:
```
GET http://localhost:8000/api/students
```

Let me know if you want the code for a full CRUD API!