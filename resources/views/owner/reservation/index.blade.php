@extends('admin.layouts.app')

@section('title', 'Reservation-Owner')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Reservation</h4>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Reservation</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col col-10">
                        <div class="d-flex flex-row">
                            <div class="pt-2">
                                <label class="fw-bold" for="basic-icon-default-fullname"><span class="px-3">Owner
                                        Kos</span></label>
                            </div>
                            <div class="">
                                <div class="input-group input-group-merge ps-0">
                                    <span id="basic-icon-default-fullname2"
                                        class="input-group-text border-0  fw-bold text-primary"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control border-0 fw-bold text-primary"
                                        id="basic-icon-default-fullname" placeholder="Owner Kos"
                                        value="{{ Auth::user()->name }}" aria-describedby="basic-icon-default-fullname2"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-5">
                            <div class="pt-2"><label class="fw-bold" for="basic-icon-default-fullname"><span
                                        class="px-3">Nomor Hp</span></label>
                            </div>
                            <div class="ps-1">
                                <div class="input-group input-group-merge ps-0">
                                    <span id="basic-icon-default-fullname2"
                                        class="input-group-text border-0  fw-bold text-primary"><i
                                            class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control border-0 fw-bold text-primary"
                                        id="basic-icon-default-fullname" placeholder="Owner Kos"
                                        value="{{ Auth::user()->hp }}" aria-describedby="basic-icon-default-fullname2"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            {{-- <div class="alert alert-danger" role="alert">This is a danger alert — check it out!</div> --}}
                            <div class="col col-12">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="fw-bold">Nama Penyewa</th>
                                                <th class="fw-bold">Nama Kos</th>
                                                <th class="fw-bold">Nomor Kamar</th>
                                                {{-- <th class="fw-bold">Foto</th> --}}
                                                <th class="fw-bold">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @if ($res->isEmpty())
                                                <tr>
                                                    <td colspan="5">
                                                        <p class="text-center my-5 fw-bold">Data Reservasi Belum Ada</p>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($res as $item)
                                                    {{-- @php
                                                        $path_photo = asset('storage/images/' . $item->file);
                                                        $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                                                    @endphp --}}
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium">{{ $item->rUser->name }}</span>
                                                        </td>
                                                        <td><span class="fw-medium">{{ $item->rKost->name }}</span></td>
                                                        <td><span class="fw-medium">{{ $item->rRoom->room_number }}</span>
                                                        </td>
                                                        {{-- <td><img src="{{ $path_photo }}" alt=""
                                                                class="img-fluid w-75"></td> --}}
                                                        <td>
                                                            <div class="d-flex flex-row">
                                                                @if ($item->status == 'Terisi')
                                                                    <div class="">
                                                                        <a class="btn btn-sm btn-danger"
                                                                            href="{{ route('resOwner-delete', $item->id) }}"
                                                                            onclick="return confirm('are you sure?')"><i
                                                                                class="bx bx-trash me-1"></i>
                                                                            Batalkan</a>
                                                                    </div>
                                                                @else
                                                                    <div class="me-2">
                                                                        <form
                                                                            action="{{ route('resOwner-update', $item->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-success"><i
                                                                                    class="bx bx-check me-1"></i>
                                                                                Terima</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="">
                                                                        <a class="btn btn-sm btn-danger"
                                                                            href="{{ route('resOwner-delete', $item->id) }}"
                                                                            onclick="return confirm('are you sure?')"><i
                                                                                class="bx bx-trash me-1"></i>
                                                                            Tolak</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-2">
                        <img src="{{ asset('dist-admin/assets/img/avatars/1.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
