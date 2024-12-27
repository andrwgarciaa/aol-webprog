<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // lecturer

        if (Auth::user()->user_role_id == 2) {
            $orders = DB::table('courses')
                ->where('courses.lecturer_id', '=', Auth::user()->id)
                ->orderBy('courses.updated_at', 'desc')
                ->get();
            $orders = $orders->map(function ($order) {
                $order->purchases_count = DB::table('orders')
                    ->where('course_id', $order->id)
                    ->whereIn('order_status_id', [2, 4, 5]) // purchased, ongoing, or completed
                    ->count();
                return $order;
            });
        } else // student
        {
            $orders = DB::table('orders')
                ->leftJoin('users', 'orders.student_id', '=', 'users.id')
                ->leftJoin('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
                ->leftJoin('courses', 'course_id', '=', 'courses.id')
                ->where('orders.student_id', '=', Auth::user()->id)
                ->where('orders.order_status_id', '!=', 1) // not cart
                ->select('orders.updated_at', 'order_statuses.name as status', 'courses.*')
                ->orderBy('orders.updated_at', 'desc')
                ->get();
        }

        return view('orders.index', compact('orders'));
    }

    // add to cart
    public function store(Request $request)
    {
        $order = Order::where('student_id', Auth::user()->id)
            ->where('course_id', $request->id)
            ->first();

        if ($order) {
            $order->order_status_id = 1; // cart
        } else {
            $order = new Order;
            $order->student_id = Auth::user()->id;
            $order->order_status_id = 1; // cart
            $order->course_id = $request->id;
        }
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // show cart
    public function cart()
    {
        $cartItems = DB::table('orders')
            ->leftJoin('courses', 'orders.course_id', '=', 'courses.id')
            ->where('orders.student_id', '=', Auth::user()->id)
            ->where('orders.order_status_id', '=', 1)
            ->select('orders.updated_at', 'courses.*')
            ->get();

        return view('orders.cart', compact('cartItems'));
    }

    // purchase
    public function purchase(Request $request)
    {
        $courseIds = $request->input('course_ids');
        if (is_string($courseIds)) {
            $courseIds = array_map('intval', explode(',', $courseIds));
        } else {
            $courseIds = array_map('intval', (array) $courseIds);
        }

        foreach ($courseIds as $courseId) {
            $order = Order::where('student_id', Auth::user()->id)
                ->where('course_id', $courseId)
                ->where('order_status_id', 1) // cart
                ->first();

            if ($order) {
                $order->order_status_id = 2; // purchased
                $order->save();
            }
        }

        return redirect()->route('orders.index')->with('success', 'Courses purchased successfully.');
    }

    // start course
    public function start(Request $request)
    {
        $order = Order::where('student_id', Auth::user()->id)
            ->where('course_id', $request->id)
            ->where('order_status_id', 2) // purchased
            ->first();

        if ($order) {
            $order->order_status_id = 4; // ongoing
            $order->save();
        }

        return redirect()->route('orders.index')->with('error', 'Course not purchased.');
    }
}
