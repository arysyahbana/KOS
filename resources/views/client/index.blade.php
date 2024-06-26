@extends('layouts.client.app')

@section('title', 'Home - Client Kos')

@section('main-content')
    <div class="banner text-center relative">
        <div class="flex flex-col absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <p class="font-bold text-3xl md:text-4xl lg:text-5xl tracking-[0.2rem] text-white mb-10">
                TEMUKAN KOS IMPIAN MU DISINI</p>

            <form action="{{ route('search-home') }}" class="w-full mx-auto" method="GET">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Cari Kos Idamanmu..." name="search" value="{{ request('search') }}" />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Cari</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Kost --}}
    <div class="container mx-auto text-center my-28">
        <p class="text-2xl font-bold md:tracking-[0.2rem]">KOS YANG TERSEDIA</p>
        <p class="text-gray-500 text-md px-5 lg:px-96 mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Commodi
            vero
            quod tempora. Excepturi reiciendis suscipit saepe deleniti ratione, eligendi dicta.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-10 justify-items-center">

            @foreach ($kosts as $item)
                @php
                    $path_photo = asset('storage/images/' . $item->file);
                    $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                @endphp
                <div class="mx-5 mt-3 max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{ $path_photo }}" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $item->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item->alamat }}</p>
                        <a href="{{ route('roomClient-show', [$item->id]) }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90  rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- <hr class="border-t-1 border-[#41C9E2] my-4"> --}}

    {{-- Kamar Kost --}}
    <div class="container-fluid mx-auto text-center mt-28">
        <p class="text-2xl font-bold md:tracking-[0.2rem]">FOTO KAMAR - KAMAR KOS</p>
        <p class="text-gray-500 text-md px-5 lg:px-96 mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing
            elit.
            Commodi
            vero
            quod tempora. Excepturi reiciendis suscipit saepe deleniti ratione, eligendi dicta.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-10 mx-auto">
            @foreach ($rooms as $item)
                @php
                    $path_photo_rooms = asset('storage/images/rooms/' . $item->file);
                    $extphoto_rooms = pathinfo($path_photo_rooms, PATHINFO_EXTENSION);
                @endphp
                <img src="{{ $path_photo_rooms }}" alt="" class="w-full h-full">
            @endforeach
        </div>
    </div>
@endsection
