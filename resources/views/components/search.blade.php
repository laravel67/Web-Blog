<div id="modal" class="fixed inset-0 z-10 w-screen overflow-y-auto hidden">
    <div class="flex min-h-full justify-center p-4 text-center items-start mt-10 sm:p-0">
        <div id="modal-content"
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <!-- Konten modal Anda di sini -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    {{-- <form action="{{ route('posts.search') }}" method="GET"
                        class="flex items-center rounded-md bg-white pl-3 border border-gray-300 focus-within:border-primary">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="block lg:min-w-100 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                            placeholder="Pencarian...">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
                            Cari
                        </button>
                    </form> --}}

                    <form action="{{ route('posts.search') }}" method="GET"
                        class="flex items-center rounded-md bg-white pl-3 border border-gray-300 focus-within:border-primary transition-colors duration-200 focus-within:ring-2 focus-within:ring-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="block lg:min-w-90 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                            placeholder="Cari artikel..." aria-label="Kata kunci pencarian" autocomplete="off">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-600 transition-colors duration-200 sm:ml-3 sm:w-auto"
                            aria-label="Submit pencarian">
                            Cari
                        </button>
                    </form>


                    {{-- <form action="{{ route('posts.search') }}" method="GET"
                        class="flex items-center rounded-md bg-white pl-3 border border-gray-300 focus-within:border-primary transition-colors duration-200">
                        <input type="text" name="search" id="search" value="{{ request('q') }}" class="block w-full lg:min-w-[100px] grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                                            focus:outline-none sm:text-sm/6" placeholder="Cari artikel..." aria-label="Cari artikel">
                    
                        <button type="submit"
                            class="inline-flex justify-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 transition-colors duration-200 sm:ml-3 sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="sr-only">Cari</span>
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
