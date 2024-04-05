<nav class="navbar fixed top-0 w-full z-10 bg-black md:bg-transparent" id="navbar">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('client-panel') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('dist-admin/assets/img/kosaya.png') }}" class="h-10" alt="Flowbite Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap">Kosaya</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if (Route::has('login'))
                <div class="sm:top-0 sm:right-0 text-right">
                    @auth
                        @if (Auth::user()->role == 'Client')
                            @php
                                $path_photo = asset('storage/images/profile/' . Auth::user()->foto);
                                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                            @endphp
                            <div class="flex flex-row">
                                <img class="w-8 h-8 mt-1 mx-2 rounded-full shadow-lg mx-auto border"
                                    src="{{ $path_photo }}" alt="Bonnie image" />
                                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                    class="flex items-center justify-between w-full py-2 px-3 md:border-0 md:p-0 md:w-auto border">{{ Auth::user()->name }}
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg></button>
                            </div>

                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar"
                                class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <a href="{{ route('profileClient-show', Auth::user()->id) }}"
                                            class="block px-4 py-2 text-center hover:bg-gray-100">Profile</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100">Sign
                                            out</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="mt-2">
                                <a href="@if (Auth::user()->role == 'Admin') {{ route('admin-panel') }} @elseif (Auth::user()->role == 'Owner') {{ route('owner-panel') }} @endif"
                                    class="text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Dashboard</a>
                            </div>
                        @endif
                    @else
                        <div class="mt-2">
                            <a href="{{ route('login') }}"
                                class="text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <li>
                    <a href="{{ route('client-panel') }}"
                        class="{{ $page == 'home-client' ? 'text-[#FFCB42]' : '' }} block py-2 px-3 rounded hover:bg-[#FFCB42] md:hover:bg-transparent md:hover:text-[#FFCB42] md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('clientShow-kost') }}"
                        class="{{ $page == 'cari-kost' ? 'text-[#FFCB42]' : '' }} block py-2 px-3 rounded hover:bg-[#FFCB42] md:hover:bg-transparent md:hover:text-[#FFCB42] md:p-0">Cari
                        Kos</a>
                </li>

                @auth
                    <li>
                        <a href="{{ route('clientShow-res', Auth::user()->id) }}"
                            class="{{ $page == 'show-res' ? 'text-[#FFCB42]' : '' }} block py-2 px-3 rounded hover:bg-[#FFCB42] md:hover:bg-transparent md:hover:text-[#FFCB42] md:p-0">Reservasi</a>
                    </li>
                @else
                    <li>
                        <a href="#" onclick="alert('login dulu bang!')"
                            class="{{ $page == 'show-res' ? 'text-[#FFCB42]' : '' }} block py-2 px-3 rounded hover:bg-[#FFCB42] md:hover:bg-transparent md:hover:text-[#FFCB42] md:p-0">Reservasi</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
