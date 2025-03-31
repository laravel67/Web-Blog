<div class="hidden transition transform opacity-0 scale-95 duration-200 ease-out" id="mobile-menu">
    <div class="space-y-1 px-2 pt-2 pb-3">
        <a href="{{ route('home') }}"
            class="block rounded-md px-3 py-2 text-base font-medium 
           {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}" aria-current="page">
            Home
        </a>

        @foreach ($categories as $category)
        <a href="{{ route('posts.category', $category->slug) }}"
            class="block rounded-md px-3 py-2 text-base font-medium 
               {{ request()->routeIs('posts.category') && request()->slug == $category->slug ? 'bg-primary text-white' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
</div>