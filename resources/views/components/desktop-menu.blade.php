<div class="hidden sm:flex space-x-4">
    <a href="{{ route('home') }}" class="px-3 py-2 text-[1rem] font-medium rounded-md 
       {{ request()->routeIs('home') ? 'text-primary' : 'hover:text-primary text-gray-800' }}">
        Home
    </a>

    @foreach ($categories as $category)
    <a href="{{ route('posts.category', $category->slug) }}"
        class="px-3 py-2 text-sm font-medium rounded-md text-[1rem] 
           {{ request()->routeIs('posts.category') && request()->slug == $category->slug ? 'text-primary' : 'hover:text-primary text-gray-800' }}">
        {{ $category->name }}
    </a>
    @endforeach
</div>