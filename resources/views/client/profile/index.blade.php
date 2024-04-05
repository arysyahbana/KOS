@extends('layouts.client.app')

@section('title', 'Profile - Edit Profile Client')

@section('main-content')
    <div class="banner text-center relative">
        <div class="flex flex-col absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <p class="font-bold text-3xl md:text-4xl lg:text-5xl tracking-[0.2rem] text-white mb-10">
                EDIT PROFILE CLIENT</p>
            <p class="font-thin text-3xl md:text-4xl lg:text-5xl tracking-[0.1rem] text-white mb-10">{{ Auth::user()->name }}
            </p>
        </div>
    </div>

    {{-- Owner --}}
    <div class="container mx-auto my-24">
        <form class="max-w-md mx-auto" action="{{ route('profileClient-update', Auth::user()->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @php
                $path_photo = asset('storage/images/profile/' . Auth::user()->foto);
                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
            @endphp
            <img class="w-32 h-32 mb-3 rounded-full shadow-lg mx-auto" src="{{ $path_photo }}" alt="Bonnie image" />
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="name" id="name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ Auth::user()->name }}" />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="file" name="foto" id="foto"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="foto"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ganti
                    Foto</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ Auth::user()->email }}" />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat
                    Email</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                @php
                    $user_hp = Auth::user()->hp;
                    $formatted_hp = preg_replace('/^\+628/', '08', $user_hp);
                @endphp
                @if (strpos($user_hp, '+62') !== false)
                    <input type="number" name="hp" id="hp"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        value="{{ $formatted_hp }}" />
                    <label for="hp"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nomor
                        HP</label>
                @endif

            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="alamat" id="alamat"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ Auth::user()->alamat }}" />
                <label for="alamat"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password" id="password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        </form>

        {{-- <p class="text-2xl font-bold md:tracking-[0.2rem]">OWNER - OWNER KOS</p>
        <p class="text-gray-500 text-md px-5 lg:px-96 mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Commodi
            vero
            quod tempora. Excepturi reiciendis suscipit saepe deleniti ratione, eligendi dicta.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-10 justify-items-center">

            @foreach ($owner as $item)
                @php
                    $path_photo = asset('storage/images/' . $item->file);
                    $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                @endphp
                <div class="w-80 max-w-sm bg-white border border-gray-200 rounded-lg shadow mt-5">
                    <div class="flex flex-col items-center py-10">
                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                            src="{{ asset('dist-admin/assets/img/avatars/1.png') }}" alt="Bonnie image" />
                        <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $item->name }}</h5>
                        <span class="text-sm text-gray-500">{{ $item->email }}</span>
                        <div class="flex mt-4 md:mt-6">
                            <a href="#"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go
                                to Kos</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
@endsection
