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
            $course = Course::find($request->id);
        }

        return view('courses.show', compact('course'));
    }
}
