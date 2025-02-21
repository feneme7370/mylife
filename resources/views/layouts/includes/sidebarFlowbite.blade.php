{{-- navbar --}}
<nav class="fixed top-0 z-50 w-full bg-purple-700 border-b border-purple-300">
    <div class="px-3 py-3 sm:px-5 sm:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm bg-purple-300 text-purple-700 rounded-lg sm:hidden hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-200 ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                {{-- logo izquierda --}}
                <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                    {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                    --}}
                    <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1335891621i/6596839.jpg" class="h-8 me-3"
                        alt="FlowBite Logo" />
                    <span
                        class="self-center text-gray-100 text-xl font-semibold sm:text-2xl whitespace-nowrap">MyLife</span>
                </a>

            </div>

            <div class="flex items-center">
                <div class="flex items-center ms-3">

                    {{-- imagen en miniatura --}}
                    <div>
                        <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 "
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1335891621i/6596839.jpg" alt="user photo">
                        </button>
                    </div>


                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 mb-1" role="none">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate " role="none">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">

                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-purple-100   "
                                    role="menuitem">
                                    <x-sistem.icons.for-icons-app icon="dashboard" />
                                    Dashboard
                                </a>
                            </li>
                            
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-purple-100 w-full"
                                        role="menuitem">
                                        <x-sistem.icons.for-icons-app icon="logout" />
                                        Cerrar sesion
                                    </button>

                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- sidebar --}}
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-purple-100 border-r border-purple-300 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto mb-10">

        {{-- listado inicial --}}
        <ul class="space-y-2 font-medium">
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('dashboard') }}"
                :active="request()->routeIs('dashboard')" title="Panel Principal">
                <x-sistem.icons.for-icons-app icon="dashboard" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>

            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('book_dashboard') }}"
                :active="request()->routeIs('book_dashboard')" title="Libros">
                <x-sistem.icons.for-icons-app icon="book" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>

            <li class="border-t border-purple-300"></li>
              

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-sistem.navlinks.navbutton-sidebar-flowbite title="Cerrar Sesion" type="submit">
                    <x-sistem.icons.for-icons-app icon="logout" />
                </x-sistem.navlinks.navbutton-sidebar-flowbite>
            </form>

            <li class="border-t border-purple-300"></li>

        </ul>
        
    </div>
</aside>
