<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Notification -->
    <div id="notification" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md opacity-0 transition-opacity duration-300 hidden">
        📋 Course URL copied!
    </div>

    <!-- Navigation -->
    <nav class="bg-gray-800 shadow-lg py-4">
        <div class="container mx-auto flex justify-center space-x-6">
            <a href="/dashboard" class="text-white hover:text-blue-400 transition font-medium">Home</a>
            <a href="/my-courses" class="text-white hover:text-blue-400 transition font-medium">My Courses</a>
            <a href="/create/course" class="text-white hover:text-blue-400 transition font-medium">Create Course</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-8 max-w-3xl">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-400">Your Courses</h1>

        @if($courses->isEmpty())
            <p class="text-center text-gray-400 text-lg">No courses available.</p>
        @else
            <div class="space-y-6">
                @foreach($courses as $course)
                    <div class="bg-gray-800 shadow-lg shadow-blue-500/50 rounded-lg p-6 border border-gray-700">
                        <h2 class="text-2xl font-bold text-blue-400">{{ $course->title }}</h2>
                        <p class="text-gray-300 mt-2">{{ $course->description }}</p>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-4 mt-4">
                            <a href="{{ route('courses.edit', $course->id) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                                Edit
                            </a>

                            <button onclick="copyCourseUrl({{ $course->id }})" 
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                                📋 Copy URL
                            </button>

                            <button onclick="openModal({{ $course->id }})" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition-all">
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div id="deleteModal-{{ $course->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity">
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-96 text-center border border-gray-700">
                            <h2 class="text-lg font-bold text-red-400">Confirm Delete</h2>
                            <p class="text-gray-300 mt-2">Are you sure you want to delete this course?</p>
                            
                            <div class="flex justify-center space-x-4 mt-4">
                                <button onclick="closeModal({{ $course->id }})" 
                                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-all">
                                    Cancel
                                </button>

                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all">
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

    <!-- Footer -->
    <footer class="w-full bg-gray-800 text-white text-center py-4 mt-10 shadow-lg border-t border-gray-700">
        <p class="text-gray-400">&copy; {{ date('Y') }} My Courses. All Rights Reserved.</p>
    </footer>

    <!-- Modal & Copy URL Scripts -->
    <script>
        function openModal(courseId) {
            document.getElementById(`deleteModal-${courseId}`).classList.remove('hidden');
        }

        function closeModal(courseId) {
            document.getElementById(`deleteModal-${courseId}`).classList.add('hidden');
        }

        function copyCourseUrl(courseId) {
            const url = `http://localhost:8000/courses/${courseId}`;
            navigator.clipboard.writeText(url).then(() => {
                showNotification();
            }).catch(err => {
                console.error("Failed to copy: ", err);
            });
        }

        function showNotification() {
            const notification = document.getElementById("notification");
            notification.classList.remove("hidden", "opacity-0");
            notification.classList.add("opacity-100");

            setTimeout(() => {
                notification.classList.add("opacity-0");
                setTimeout(() => notification.classList.add("hidden"), 300);
            }, 3000);
        }
    </script>

</body>
</html>
