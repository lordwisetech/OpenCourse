<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends  Controller
{
    public function create()
    {
        return view('courses.create');
    }
    

    # store method
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'contents' => 'nullable|array',
            'contents.*.heading' => 'nullable|string',
            'contents.*.text' => 'nullable|string',
            'contents.*.code' => 'nullable|string',
        ]);
        
        // Ensure the user is logged in
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'contents' => $request->contents,
            'user_id' => auth()->id(), // ✅ Ensure user_id is included
        ]);
        
        return redirect('/my-courses')->with('success', 'Course updated successfully!');
        
    }
    


public function index(Request $request)

{
    $query = Course::query();

    // Search by course title
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Retrieve the filtered courses
    $courses = $query->get();

    return view('all', compact('courses'));



}


public function destroy($id)
    {
        $course = Course::find($id);
        
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }

        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }


    public function edit($id)
{
    $course = Course::findOrFail($id);  // Fetch the course by ID
    return view('edit', compact('course')); // Pass course data to view
}



public function update(Request $request, $id)
{
    $course = Course::find($id);
    if (!$course) {
        return back()->with('error', 'Course not found!');
    }

    $course->title = $request->title;
    $course->description = $request->description;
    $course->video_url = $request->video_url;
    $course->contents = $request->contents;
    $course->save(); // Force save

    return redirect('/my-courses')->with('success', 'Course updated successfully!');
}

    


public function show($id)
{
    $course = Course::with('user', 'contents')->findOrFail($id);
    return view('coursesshow', compact('course'));
}

public function myCourses()
{
    $courses = Course::where('user_id', auth()->id())->get(); // Get only the logged-in user's courses

    return view('my_courses', compact('courses')); // Ensure this Blade file exists
}





    // Add other methods (index, show, etc.) as needed.
}
