@extends('admin.layouts.app')

@section('title', 'Reservations')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Reservations</h4>
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data
                Reservations</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">Nama Penyewa</th>
                            <th class="fw-bold">Nama Kos</th>
                            <th class="fw-bold">Foto Kos</th>
                            <th class="fw-bold">Nomor Kamar</th>
                            <th class="fw-bold">Foto Kamar</th>
                            <th class="fw-bold">Harga Kamar</th>
                            <th class="fw-bold">Status</th>
                            <th class="fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($reservations->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <p class="text-center my-5 fw-bold">Tidak ada data reservations</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($reservations as $item)
                                @php
                                    $path_photo = asset('storage/images/' . $item->rKost->file);
                                    $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                                    $path_photo_rooms = asset('storage/images/rooms/' . $item->rRoom->file);
                                    $extphoto_rooms = pathinfo($path_photo_rooms, PATHINFO_EXTENSION);
                                @endphp
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{ $item->rUser->name }}</span>
                                    </td>
                                    <td><span class="fw-medium">{{ $item->rKost->name }}</span></td>
                                    <td style="max-width: 10rem"><span class="fw-medium"><img src="{{ $path_photo }}"
                                                alt="" class="img-fluid"></span></td>
                                    <td><span class="fw-medium">{{ $item->rRoom->room_number }}</span></td>
                                    <td style="max-width: 10rem"><span class="fw-medium"><img src="{{ $path_photo_rooms }}"
                                                alt="" class="img-fluid"></span></td>
                                    <td><span class="fw-medium">Rp. {{ $item->rRoom->price }}</span></td>
                                    <td><span class="fw-medium">{{ $item->status }}</span></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" href="{{ route('res-delete', $item->id) }}"
                                            onclick="return confirm('are you sure?')"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
