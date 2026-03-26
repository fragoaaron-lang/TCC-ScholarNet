<nav class="bg-white border-b border-gray-200 p-4 flex justify-between">
    <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg">Admin Panel</a>
    </div>

    <div class="flex items-center space-x-4">
        <span>{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-red-500">Logout</button>
        </form>
    </div>
</nav>
