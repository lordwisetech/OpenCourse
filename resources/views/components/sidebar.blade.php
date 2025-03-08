<div x-data="{ open: false }" class="relative">
    <!-- Hamburger Menu Button (Mobile) -->
    <button @click="open = !open" class="md:hidden p-4 text-white bg-gray-900 fixed top-4 left-1  z-50 rounded-lg shadow-lg">
        
    </button>

    <!-- Sidebar -->
    <div 
        :class="open ? 'translate-x-0' : '-translate-x-full'" 
        class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white flex flex-col p-6 transform transition-transform duration-300 ease-in-out md:relative">
        
        <h2 class="text-xl font-bold   mb-6">Dashboard</h2>
        <nav class="flex flex-col space-y-4">
            <a href="/dashboard/student"  class="hover:bg-gray-700 p-2 rounded">Students Mode</a>
            <a href="/create/course"  class="hover:bg-gray-700 p-2 rounded">Create Course</a>
            <a href="/courses"class="hover:bg-gray-700 p-2 rounded">Update course</a>
           
            <a href="#" @click="open = false" class="hover:bg-gray-700 p-2 rounded">My Students</a>
          
            
            <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg shadow-md mt-6 text-center">Logout</a>
        </nav>
    </div>
</div>