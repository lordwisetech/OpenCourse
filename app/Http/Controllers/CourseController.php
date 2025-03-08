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
    
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title'       => 'required|string|max:500',
            'description' => 'required|string',
            'video_url'   => 'nullable|url',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contents'    => 'nullable|array',
            'contents.*'  => 'string|max:500'
        ]);

        // Handle file upload for thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $thumbnailPath = null;
        }

        // Create the course and associate with the logged-in user
        Course::create([
            'title'       => $request->title,
            'description' => $request->description,
            'video_url'   => $request->video_url,
            'thumbnail'   => $thumbnailPath,
            'contents'    => $request->contents, // Stored as JSON thanks to model casting
            'user_id'     => Auth::id(),
        ]);


        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }


public function index()
{
    $userId = Auth::id(); // Get the logged-in user ID
    $courses = Course::where('user_id', $userId)->get(); // Fetch only user's courses
    return view('courses', compact('courses'));// Return courses as JSON
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
        $course = Course::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }

        return view('edit', compact('course'));
    }


    public function update(Request $request, $id)
{
    $course = Course::find($id);

    if (!$course) {
        return redirect()->back()->with('error', 'Course not found');
    }

    $course->title = $request->input('title');
    $course->description = $request->input('description');
    $course->video_url = $request->input('video_url');

    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $course->thumbnail = $thumbnailPath;
    }

    $course->save();

    return redirect()->route('courses.index')->with('success', 'Course updated successfully');
}


    // Add other methods (index, show, etc.) as needed.
}
