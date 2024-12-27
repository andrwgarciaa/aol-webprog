<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function coursesIndex()
    {
        $courses = Course::all();

        return view('courses.index')->with('courses', $courses);
    }

    public function courseDetailIndex(Request $request)
    {
        if (Auth::user() && Auth::user()->user_role_id === 3) {
            $course = DB::table('courses')
                ->leftJoin('orders', 'orders.course_id', '=', 'courses.id')
                ->leftJoin('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
                ->leftJoin('users', 'courses.lecturer_id', '=', 'users.id')
                ->where('orders.course_id', $request->id)
                ->where('orders.student_id', Auth::user()->id)
                ->select('orders.updated_at', 'order_statuses.name as status', 'order_statuses.id as status_id', 'courses.*', 'users.name as lecturer_name')
                ->first();
            if (!$course) {
                $course = DB::table('courses')
                    ->leftJoin('users', 'courses.lecturer_id', '=', 'users.id')
                    ->where('courses.id', $request->id)
                    ->select('courses.*', 'users.name as lecturer_name')
                    ->first();
            }
        } else {
            $course = DB::table('courses')
                ->leftJoin('users', 'courses.lecturer_id', '=', 'users.id')
                ->where('courses.id', $request->id)
                ->select('courses.*', 'users.name as lecturer_name')
                ->first();
        }

        return view('courses.show', compact('course'));
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);

        return view('courses.edit-course', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->price = $request->input('price');
        $course->save();

        return redirect()->route('courses.show', ['id' => $id])
            ->with('success', 'Course updated successfully');
    }
}
