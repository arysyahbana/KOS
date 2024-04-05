@extends('admin.layouts.app')

@section('title', 'Add Kosts-Owner')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Kosts /</span> Add Kost</h4>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-primary"><i class="menu-icon tf-icons bx bx-group bx-tada-hover"></i> Data Kost</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kostOwner-store') }}" id="formAccountSettings" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Owner Kos</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="basic-icon-default-fullname"
                                    placeholder="Nama Owner" aria-describedby="basic-icon-default-fullname2"
                                    value="{{ Auth::user()->name }}" name="user_id" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row
                                    mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Nama Kost</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-buildings"></i></span>
                                <input type="text" id="basic-icon-default-company" class="form-control"
                                    placeholder="Nama Kost" aria-describedby="basic-icon-default-company2"
                                    name="nama_kost" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Alamat</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="basic-icon-default-email" class="form-control"
                                    placeholder="Alamat" name="alamat" aria-describedby="basic-icon-default-email2" />

                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Jumlah Kamar</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="bx bx-phone"></i></span>
                                <input type="number" id="basic-icon-default-phone" class="form-control phone-mask"
                                    placeholder="Jumlah Kamar" name="rooms"
                                    aria-describedby="basic-icon-default-phone2" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Foto Kos</label>
                        <div class="col-sm-10">
                            <div class="mb-3 col-md-12">
                                <input class="form-control" type="file" id="picture" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
