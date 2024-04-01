@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Users /</span> Edit User</h4>
        <div class="card mb-4">
            <h5 class="card-header text-primary">Edit User</h5>
            <hr class="my-0" />
            <div class="card-body">
                <form action="{{ route('user-update', $edit->id) }}" id="formAccountSettings" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Fullname"
                                value="{{ $edit->name }}" autofocus />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email"
                                placeholder="Email Address" value="{{ $edit->email }}" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="hp">Nomor HP</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">IND (+62)</span>
                                <input type="text" id="hp" name="hp" class="form-control"
                                    placeholder="811 2222 3434" value="{{ $edit->hp }}" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                value="{{ $edit->alamat }}" />
                        </div>
                        {{-- <div class="mb-3 col-md-12">
                            <label for="state" class="form-label">State</label>
                            <input class="form-control" type="text" id="state" name="state"
                                placeholder="California" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="zipCode" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465"
                                maxlength="6" />
                        </div> --}}
                        <div class="mb-3 col-md-12">
                            <label for="role" class="form-label">Akun ini sebagai</label>
                            <select id="role" class="select2 form-select" name="role">
                                <option value="">Select</option>
                                <option value="Owner" {{ $edit->role == 'Owner' ? 'selected' : '' }}>Owner</option>
                                <option value="Client" {{ $edit->role == 'Client' ? 'selected' : '' }}>Client</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password" name="password"
                                placeholder="Password" autofocus />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary btn-sm me-2">Update</button>
                        <button type="reset" class="btn btn-outline-secondary btn-sm">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection
