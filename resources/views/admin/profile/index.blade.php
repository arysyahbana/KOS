@extends('admin.layouts.app')

@section('title', 'Admin-Profile')

@section('main-content')
    <div class="container mt-5">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">My Profile /</span> Edit</h4>
        <div class="card mb-4">
            <!-- Account -->
            <div class="card-body">
                <form action="{{ route('profile-update', Auth::user()->id) }}" id="formAccountSettings" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @php
                            $path_photo = asset('storage/images/profile/' . Auth::user()->foto);
                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                        @endphp
                        <img src="{{ $path_photo }}" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" name="foto" />
                            </label>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ Auth::user()->name }}" placeholder="Masukan Nama" autofocus />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email"
                                value="{{ Auth::user()->email }}" placeholder="Masukan Email" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="hp">Nomor HP</label>
                            <div class="input-group input-group-merge">
                                @php
                                    $user_hp = Auth::user()->hp;
                                    $formatted_hp = preg_replace('/^\+62/', '', $user_hp);
                                @endphp
                                @if (strpos($user_hp, '+62') !== false)
                                    <span class="input-group-text">IND (+62)</span>
                                @endif
                                <input type="text" id="hp" name="hp" class="form-control"
                                    placeholder="823 555 0111" value="{{ $formatted_hp }}" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Masukan Alamat" value="{{ Auth::user()->alamat }}" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password" name="password"
                                placeholder="Masukan Password" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <div class="card">
            <h5 class="card-header">Hapus Akun</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading mb-1">Apakah Anda yakin ingin menghapus akun Anda?</h6>
                        <p class="mb-0">Setelah Anda menghapus akun Anda, tidak ada jalan untuk kembali. Mohon dipastikan.
                        </p>
                    </div>
                </div>
                <form id="formAccountDeactivation" action="{{ route('profile-destroy', [Auth::user()->id]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger deactivate-account"
                        onclick="alert('Anda yakin ingin menghapus akun?')">Nonaktifkan Akun</button>
                </form>
            </div>
        </div>
    </div>
@endsection
