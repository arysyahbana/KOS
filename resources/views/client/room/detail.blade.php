@extends('layouts.client.app')

@section('title', 'Client Room-detail')

@section('main-content')
    <div class="banner text-center relative">
        <div class="flex flex-col absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 min-w-96">
            <p class="font-bold text-3xl md:text-4xl lg:text-5xl tracking-[0.2rem] text-white mb-1">
                {{ $room->rKost->name }}</p>
            <p class="font-thin text-3xl md:text-4xl lg:text-5xl tracking-[0.1rem] text-white mb-10">Kamar No
                {{ $room->room_number }}
            </p>
        </div>
    </div>

    <div class="container mx-auto my-10">
        <p class="text-center text-3xl mb-5">Detail Kamar</p>
        <div class="grid grid-cols-1 md:grid-cols-4">
            @php
                $path_photo = asset('storage/images/rooms/' . $room->file);
                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
            @endphp

            <div class="p-5 sm:col-span-3 max-h-[35rem]">
                <img src="{{ $path_photo }}" alt="" class="rounded-xl object-cover object-cover w-full h-full">
            </div>

            <div class="p-5 text-md my-auto md:p-2 md:text-xs lg:p-5 lg:text-base">
                <div class="bg-white rounded-2xl p-10 w-full shadow">
                    <p class="mb-1">{{ $room->rKost->name }}</p>
                    <p class="mb-1">Nomor Kamar: {{ $room->room_number }}</p>
                    <p class="mb-1">Fasilitas: {{ $room->fasilitas }}</p>
                    <p class="mb-5">Harga: Rp.{{ $room->price }}</p>
                    <form action="{{ route('reservasiClient-update', [$room->id]) }}" method="post">
                        @csrf
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90  rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Reservasi
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <p class="px-0 text-center md:px-8 md:text-start">Lainnya di {{ $room->rKost->name }}...</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-items-center">
                @foreach ($rooms as $item)
                    @php
                        $path_photo = asset('storage/images/rooms/' . $item->file);
                        $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                    @endphp
                    <div class="mx-5 mt-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <a href="#">
                            <img class="rounded-t-lg h-[12rem] min-w-[20rem]" src="{{ $path_photo }}" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900">Nomor :
                                    {{ $item->room_number }}</h5>
                            </a>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Harga : Rp.{{ $item->price }}</p>
                            <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">Status : {{ $item->status }}</p>
                            <a href="{{ route('roomDetail-show', [$item->id]) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gradient-to-r from-[#41C9E2] to-[#008DDA] hover:opacity-90  rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Detail
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
