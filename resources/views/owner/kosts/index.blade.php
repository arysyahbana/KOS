@extends('admin.layouts.app')

@section('title', 'Kosts-Owner')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Kosts</h4>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Kost</h5>
                <a href="{{ route('kostOwner-add') }}" class="btn btn-sm btn-primary mb-2 mx-3">Add Data Kost</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col col-9">
                        <div class="d-flex flex-row mb-5">
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
                        <div class="row mb-3">
                            <div class="alert alert-danger" role="alert">This is a danger alert — check it out!</div>
                            <div class="col col-12">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="fw-bold">Nama Kos</th>
                                                <th class="fw-bold">Alamat</th>
                                                <th class="fw-bold">Jumlah Kamar</th>
                                                <th class="fw-bold">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @if ($kosts->isEmpty())
                                                <tr>
                                                    <td colspan="5">
                                                        <p class="text-center my-5 fw-bold">Data Kost Belum di input</p>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($kosts as $item)
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium">{{ $item->name }}</span>
                                                        </td>
                                                        <td><span class="fw-medium">{{ $item->alamat }}</span></td>
                                                        <td><span class="fw-medium">{{ $item->rooms }}</span></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                    class="btn p-0 dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('kostOwner-edit', $item->id) }}"><i
                                                                            class="bx bx-edit-alt me-1"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('kostOwner-delete', $item->id) }}"
                                                                        onclick="return confirm('are you sure?')"><i
                                                                            class="bx bx-trash me-1"></i>
                                                                        Delete</a>
                                                                </div>
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

                    <div class="col col-3">
                        <img src="{{ asset('dist-admin/assets/img/avatars/1.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Rooms
                </h5>
                <a href="{{ route('roomOwner-add') }}" class="btn btn-sm btn-primary mb-4 mx-3">Add Room</a>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">Nama Kos</th>
                            <th class="fw-bold">Nomor Kamar</th>
                            <th class="fw-bold">Harga</th>
                            <th class="fw-bold">Status</th>
                            <th class="fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($rooms->isEmpty())
                            <tr>
                                <td colspan="5">
                                    <p class="text-center my-5 fw-bold">Data Kamar Belum di input</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($rooms as $item)
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{ $item->rKost->name }}</span>
                                    </td>
                                    <td><span class="fw-medium">{{ $item->room_number }}</span></td>
                                    <td><span class="fw-medium">{{ $item->price }}</span></td>
                                    <td><span class="fw-medium">{{ $item->status }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('roomOwner-edit', $item->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="{{ route('roomOwner-delete', $item->id) }}"
                                                    onclick="return confirm('are you sure?')"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="card">
            <h5 class="card-header text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Kost</h5>
            <div class="table-responsive text-nowrap">
                <div class="card-body">
                    <form action="{{ route('kostOwner-update', Auth::user()->id) }}" id="formAccountSettings" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="user_id" class="form-label">Owner Kos</label>
                                <input class="form-control" type="text" id="name" name="name" readonly
                                    value="{{ Auth::user()->name }}" />
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Nama Kost</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Fullname"
                                    @if ($kosts->isNotEmpty()) value="{{ $kosts->first()->name }}" @endif />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Alamat"
                                    @if ($kosts->isNotEmpty()) value="{{ $kosts->first()->alamat }}" @endif />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="room" class="form-label">Jumlah Kamar</label>
                                <input type="number" class="form-control" id="room" name="room"
                                    placeholder="Jumlah kamar"
                                    @if ($kosts->isNotEmpty()) value="{{ $kosts->first()->rooms }}" @endif />
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-sm btn-primary me-2">Update</button>
                            <button type="reset" class="btn btn-sm btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
