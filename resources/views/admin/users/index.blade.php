@extends('admin.layouts.app')

@section('title', 'Users')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Users</h4>
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Users</h5>
            <div class="table-responsive text-nowrap">
                <a href="{{ route('user-add') }}" class="btn btn-sm btn-primary mb-4 mx-3">Add User</a>
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">Nama</th>
                            <th class="fw-bold">Email</th>
                            <th class="fw-bold">No HP</th>
                            <th class="fw-bold">Alamat</th>
                            <th class="fw-bold">role</th>
                            <th class="fw-bold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($users->isEmpty() && $users->contains('role', 'Admin'))
                            <tr>
                                <td colspan="6">
                                    <p class="text-center my-5 fw-bold">User Belum Ada</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($users as $item)
                                @if ($item->role != 'Admin')
                                    <tr>
                                        <td>
                                            <span class="fw-medium">{{ $item->name }}</span>
                                        </td>
                                        <td><span class="fw-medium">{{ $item->email }}</span></td>
                                        <td>
                                            <span class="fw-medium">{{ $item->hp }}</span>
                                        </td>
                                        <td><span class="fw-medium">{{ $item->alamat }}</span></td>
                                        <td><span class="fw-medium">{{ $item->role }}</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('user-edit', $item->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{ route('user-delete', $item->id) }}"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
