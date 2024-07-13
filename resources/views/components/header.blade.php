<header class="bg-white border-b border-gray-100">
    <div class="flex items-center justify-between px-4 py-4 sm:px-6">
        <div class="flex items-center">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 lg:hidden focus:outline-none">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>

        <div class="flex items-center">

            <div x-data="{ dropdownOpen: false }" class="relative inline-block">

                <div class="absolute right-0 z-20 w-56 py-2 mt-2 overflow-hidden bg-white rounded-md shadow-xl rtl:right-auto rtl:left-0"
                     x-show="dropdownOpen"
                     x-cloak
                     x-transition:enter="transition ease-out duration-100 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.away="dropdownOpen = false">
                    <div class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-200 transform hover:bg-gray-100">
                        <div class="mx-1">
                            <p class="text-sm text-gray-500 text-gray-200">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <hr class="border-gray-200 ">

                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="block px-4 py-2 text-sm text-gray-600 capitalize transition-colors duration-200 transform hover:bg-gray-100 w-full">
                        Sign Out
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>