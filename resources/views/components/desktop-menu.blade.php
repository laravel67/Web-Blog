<div class="hidden sm:flex space-x-4 snap-x">
    {{-- Link Home --}}
    <a href="{{ route('home') }}" class="px-3 py-2 text-[1rem] font-medium rounded-md snap-start scroll-sm-6
              {{ request()->routeIs('home') ? 'text-white bg-primary' : 'hover:text-primary text-gray-900' }}">
        Home
    </a>

    {{-- Link Kategori --}}
    @foreach ($categories as $category)
    <a href="{{ route('posts.category', $category->slug) }}" class="px-3 py-2 text-[1rem] font-medium rounded-md snap-start scroll-sm-6
                  {{ request()->routeIs('posts.category') && request()->route('slug') == $category->slug
                     ? 'text-white bg-primary'
                     : 'hover:text-primary text-gray-900' }}">
        {{ $category->name }}
    </a>
    @endforeach
</div>