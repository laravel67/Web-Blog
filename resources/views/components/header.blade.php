<nav class="bg-white sticky top-0 z-99">
    <div class="mx-auto max-w-[87rem]">
        <div class="flex h-16 items-center justify-between text-white px-4">
            <!-- Logo -->
            <x-logo/>
            <!-- Menu -->
            <x-desktop-menu/>
            <!-- Profile -->
            <div class="flex items-center space-x-4">
                <!-- Notifikasi -->
               <x-btn-show-search/>
                <!-- Profil -->
               <x-profile/>
                <!-- Mobile Menu Toggle -->
                <x-toggle-mobile/>
            </div>
        </div>
    </div>
    <x-mobile-menu/>
</nav>