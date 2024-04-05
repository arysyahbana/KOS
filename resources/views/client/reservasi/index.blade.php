@extends('layouts.client.app')

@section('title', 'Client Room-detail')

@section('main-content')
    <div class="banner text-center relative">
        <div class="flex flex-col absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 min-w-96">
            <p class="font-bold text-3xl md:text-4xl lg:text-5xl tracking-[0.2rem] text-white mb-1">DETAIL RESERVASI
            </p>
            <p class="font-thin text-3xl md:text-4xl lg:text-5xl tracking-[0.1rem] text-white mb-10">{{ Auth::user()->name }}
            </p>
        </div>
    </div>

    @if (empty($reservations))
        ga ada data
    @else
        <div class="container mx-auto my-10">

            <div class="relative overflow-x-auto">
                <p class="tracking-[0.1rem] mb-5">Setelah status diterima, silahkan hubungi nomor owner untuk info lebih
                    lanjut
                </p>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-white uppercase bg-[#2d314d]">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Kos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto Kos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor Kamar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Foto Kamar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga Kamar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Owner
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor Owner
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $item)
                            @php
                                $path_photo = asset('storage/images/' . $item->rKost->file);
                                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                                $path_photo_rooms = asset('storage/images/rooms/' . $item->rRoom->file);
                                $extphoto_rooms = pathinfo($path_photo_rooms, PATHINFO_EXTENSION);
                            @endphp
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->rKost->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <img src="{{ $path_photo }}" alt="" class="w-28">
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->rRoom->room_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <img src="{{ $path_photo_rooms }}" alt="" class="w-28">
                                </td>
                                <td class="px-6 py-4">
                                    Rp. {{ $item->rRoom->price }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->status == 'Terisi')
                                        <span class="text-[#008DDA]">Diterima</span>
                                    @else
                                        <span class="text-[#FFCB42]">{{ $item->status }}</span>
                                    @endif
                                </td>
                                @if ($item->status)
                                    @foreach ($owners as $owner)
                                        @if ($owner->id == $item->rKost->user_id)
                                            <td class="px-6 py-4">{{ $owner->name }}</td>
                                            @if ($item->status != 'Terisi')
                                                <td class="px-6 py-4">
                                                    Tunggu Acc Owner
                                                </td>
                                            @else
                                                <td class="px-6 py-4">
                                                    <a href="https://wa.me/{{ $owner->hp }}?text=Hai%20saya%20tertarik%20dengan%20kost%20ini"
                                                        target="blank">
                                                        <div class="flex flex-row">
                                                            <div class="">
                                                                <img src="{{ asset('dist-admin/assets/img/whatsapp.png') }}"
                                                                    alt="" class="w-5">
                                                            </div>
                                                            <div class="">{{ $owner->hp }}</div>
                                                        </div>
                                                    </a>
                                                </td>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($res == '')
                    <p class="text-center font-bold text-sm my-10">Belum ada reservasi kamar</p>
                @endif
            </div>
        </div>
    @endif

@endsection
