<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - eSchool</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <nav class="bg-gray-900 shadow-lg py-4">
        <div class="container mx-auto flex justify-center space-x-6">
            <a href="/dashboard" class="text-white hover:text-blue-400 transition">Home</a>
            <a href="/courses" class="text-white hover:text-blue-400 transition"> Update Course</a>
            <a href="/create/course" class="text-white hover:text-blue-400 transition">Create Course</a>
            <a href="/create/course" class="text-white hover:text-blue-400 transition">My students</a>
           
        </div>
    </nav>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Your Courses</h1>

        @if($courses->isEmpty())
            <p class="text-center text-gray-400">No courses available.</p>
        @else
            <div class="space-y-6">
                @foreach($courses as $course)
                    <div class="bg-gray-800 shadow-lg shadow-blue-500/50 rounded-lg p-6 w-full">
                        <h2 class="text-2xl font-bold text-blue-400">{{ $course->title }}</h2>
                        <p class="text-gray-300">{{ $course->description }}</p>
                        
                        <div class="flex space-x-4 mt-4">
                            <!-- Edit Button -->
                            <a href="{{ route('courses.edit', $course->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>
                            

                            <!-- Delete Button (Triggers Modal) -->
                            <button onclick="openModal({{ $course->id }})" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="deleteModal-{{ $course->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-96 text-center">
                            <h2 class="text-lg font-bold text-white">Confirm Delete</h2>
                            <p class="text-gray-300 mt-2">Are you sure you want to delete this course?</p>
                            
                            <div class="flex justify-center space-x-4 mt-4">
                                <!-- Cancel Button -->
                                <button onclick="closeModal({{ $course->id }})" 
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                    Cancel
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                        Delete
                                    </button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function openModal(courseId) {
            document.getElementById(`deleteModal-${courseId}`).classList.remove('hidden');
        }

        function closeModal(courseId) {
            document.getElementById(`deleteModal-${courseId}`).classList.add('hidden');
        }
    </script>

</body>
</html>
