@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6 flex justify-center">
    <div class="max-w-3xl w-full">
        <!-- Header Section -->
        <div class="bg-gray-800 p-4 shadow-lg flex justify-between items-center rounded-lg border border-gray-700">
            <h1 class="text-2xl font-bold text-blue-400">{{ $course->title }}</h1>
            
            <!-- Show "Back to Courses" only for logged-in users -->
            @auth
                <a href="{{ route('courses.index') }}" 
                   class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all">
                    ← Back to Courses
                </a>
            @endauth

            
        </div>
<!-- Show Course Creator -->
<div class="mt-4 text-gray-400 text-sm">
    Created by : <span class="font-bold text-blue-400">{{ $course->user->name ?? 'Unknown' }}</span>
</div>

        <!-- Course Description -->
        <p class="mt-6 text-gray-300 text-lg leading-relaxed">
            {{ $course->description }}
        </p>

        <!-- Video Section -->
        @if(!empty($course->video_url))
            @php
                $embedUrl = $course->video_url;
                if (Str::contains($course->video_url, 'watch?v=')) {
                    $embedUrl = str_replace('watch?v=', 'embed/', $course->video_url);
                } elseif (Str::contains($course->video_url, 'youtu.be/')) {
                    $embedUrl = str_replace('youtu.be/', 'youtube.com/embed/', $course->video_url);
                }
            @endphp
            <iframe class="w-full h-64 md:h-80 rounded-lg"
                src="{{ $embedUrl }}"
                frameborder="0" allowfullscreen>
            </iframe>
        @else
            <p class="text-red-400 mt-3">No video available for this course.</p>
        @endif

        <!-- Course Content -->
        <h2 class="text-xl font-bold text-blue-400 mt-8 border-b border-gray-700 pb-2">Course Content</h2>
        <div class="mt-6 space-y-6">
            @foreach($course->contents as $content)
                <div class="p-6 bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                    <h3 class="text-lg font-semibold text-green-400">{{ $content['heading'] ?? 'Untitled Section' }}</h3>
                    <p class="text-gray-300 mt-2 leading-relaxed">{{ $content['text'] ?? '' }}</p>

                    @if(!empty($content['code']))
                        <div class="mt-4 p-4 bg-gray-900 text-green-300 rounded-lg overflow-auto shadow-md border border-gray-700">
                            <pre><code class="font-mono text-sm">{{ $content['code'] }}</code></pre>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>


        <h2 class="text-xl font-bold text-blue-400 mt-8 border-b border-gray-700 pb-2">Comments</h2>

<!-- Comment Form -->
<form action="{{ route('comments.store', $course) }}" method="POST" class="mt-4">
    @csrf
    <textarea name="comment" class="w-full p-2 rounded-lg bg-gray-800 text-white" rows="3" placeholder="Write a comment..." required></textarea>
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg">
        Post Comment
    </button>
</form>

<!-- Display Comments -->
<div class="mt-6 space-y-4">
    
    @foreach ($course->comments as $comment)
        <div class="p-4 bg-gray-800 rounded-lg shadow-md">
            <p class="text-blue-400 font-bold">
                {{ $comment->user ? $comment->user->name : $comment->guest_name }}
            </p>
            <p class="text-gray-300">{{ $comment->comment }}</p>

            <!-- Reply Form -->
            <form action="{{ route('comments.store', $course) }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="comment" class="w-full p-2 rounded-lg bg-gray-700 text-white" rows="2" placeholder="Reply..." required></textarea>
                <button type="submit" class="mt-1 px-3 py-1 bg-green-600 hover:bg-green-500 text-white rounded-lg">
                    Reply
                </button>
            </form> 
 
            <!-- Show Replies -->
            @foreach ($comment->replies as $reply)
                <div class="ml-6 mt-2 p-3 bg-gray-700 rounded-lg">
                    <p class="text-blue-400 font-bold">
                        {{ $reply->user ? $reply->user->name : $reply->guest_name }}
                    </p>
                    <p class="text-gray-300">{{ $reply->comment }}</p>
                </div>
            @endforeach
        </div>
    @endforeach
</div>  


        <!-- Show Tabs Only for Logged-in Users -->
        @auth
        <footer class="w-full bg-gray-800 text-white text-center py-4 mt-10 shadow-lg border-t border-gray-700">
            <div class="max-w-3xl mx-auto flex flex-col items-center space-y-2">
                <p class="text-gray-400">© {{ date('Y') }} WEBWIZARD. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-400 hover:underline">Privacy Policy</a>
                    <a href="#" class="text-blue-400 hover:underline">Terms of Service</a>
                    <a href="#" class="text-blue-400 hover:underline">Contact Us</a>
                </div>
            </div>
        </footer>
        
        @else
            <!-- Show Register Message for Guests -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center border border-gray-700 mt-8">
                <h1 class="text-2xl font-bold text-yellow-400">Start Learning for Free! 🚀</h1>
                <p class="text-gray-300 mt-2">Create an account to access more features.</p>
                <div class="mt-6">
                    <a href="/register" 
                       class="px-6 py-3 bg-green-600 hover:bg-green-500 text-white font-bold rounded-lg shadow-lg transition-all">
                        Register Now
                    </a>
                </div>
            </div>

            <footer class="w-full bg-gray-800 text-white text-center py-4 mt-10 shadow-lg border-t border-gray-700">
                <div class="max-w-3xl mx-auto flex flex-col items-center space-y-2">
                    <p class="text-gray-400">© {{ date('Y') }} WEBWIZARD. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-400 hover:underline">Privacy Policy</a>
                        <a href="#" class="text-blue-400 hover:underline">Terms of Service</a>
                        <a href="#" class="text-blue-400 hover:underline">Contact Us</a>
                    </div>
                </div>
            </footer>
        @endauth

    </div>
</div>
@endsection
