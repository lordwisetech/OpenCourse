<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;


class CommentController extends Controller  // ✅ Make sure it extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
    
        $comment = new Comment();
        $comment->course_id = $course->id;
        $comment->comment = $request->comment;
    
        if (auth()->check()) {
            $comment->user_id = auth()->id();
        } else {
            $comment->guest_name = $request->guest_name ?? 'Guest';
        }
    
        if ($request->has('parent_id')) {
            $comment->parent_id = $request->parent_id;
        }
    
        $comment->save();
    
        return back()->with('success', 'Comment posted successfully!');
    }
    
}
