@php use Illuminate\Support\Facades\Auth; @endphp
<div class="relative">
    <button id="user-menu-button" class="relative flex rounded-full bg-white ring-1 ring-primary">
        @auth
        <x-avatar :img="Auth::user()->avatar_url" :alt="Auth::user()->name" class="h-5 w-5 rounded-full"/>
        @else
        <img src="{{ asset('default-avatar.png') }}" class="h-5 w-5 rounded-full"/>
        @endauth
    </button>

    <!-- Dropdown Menu -->
    <div id="user-menu"
        class="absolute right-0 z-10 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none ring-2 ring-primary transition transform opacity-0 scale-95 invisible"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
    
        @foreach ($urls as $item)
        @isset($item['method'])
        <form method="POST" action="{{ $item['url'] }}" class="w-full">
            @csrf
            <button type="submit" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem">
                @isset($item['icon'])
                <x-dynamic-component :component="$item['icon']" class="h-4 w-4" />
                @endisset
                {{ $item['label'] }}
            </button>
        </form>
        @else
        <a href="{{ $item['url'] }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            role="menuitem">
            @isset($item['icon'])
            <x-dynamic-component :component="$item['icon']" class="h-4 w-4" />
            @endisset
            {{ $item['label'] }}
        </a>
        @endisset
        @endforeach
    </div>
</div>