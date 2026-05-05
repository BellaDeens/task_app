<!DOCTYPE html>
<html>
<head>
    <title>Task App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto mt-10">
        
        <!-- Logout Section -->
        <div class="flex justify-end mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-red-500 underline">
                    Logout
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Task Manager</h1>

            <!-- Add Task Form with "Enter" button at the end -->
            <form method="POST" action="/tasks" class="flex mb-4">
                @csrf
                <div class="flex w-full border rounded overflow-hidden">
                    <input type="text" name="title" 
                           class="flex-1 p-2 outline-none" 
                           placeholder="New Task" required>
                    <button class="bg-blue-500 text-black px-6 hover:bg-blue-600 transition">
                        Enter
                    </button>
                </div>
            </form>

            <!-- Task List -->
            @foreach($tasks as $task)
            <div class="flex items-center justify-between mb-2 p-2 border rounded">
                <div class="flex items-center">
                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('PATCH')
                        <button class="mr-2">
                            {{ $task->is_done ? '✅' : '⬜' }}
                        </button>
                    </form>
                    <span class="{{ $task->is_done ? 'line-through text-gray-400' : '' }}">
                        {{ $task->title }}
                    </span>
                </div>

                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 ml-4 hover:underline">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>