@extends('admin.layouts.app')

@section('title', 'Room')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Rooms</h4>
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Rooms</h5>
            <div class="table-responsive text-nowrap">
                <a href="{{ route('room-add') }}" class="btn btn-sm btn-primary mb-4 mx-3">Add Room</a>
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
                                                <a class="dropdown-item" href="{{ route('room-edit', $item->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="{{ route('room-delete', $item->id) }}"
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
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
