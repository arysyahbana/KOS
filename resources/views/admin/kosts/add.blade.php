@extends('admin.layouts.app')

@section('title', 'Add Kost')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Kosts /</span> Add Kost</h4>
        <div class="card mb-4">
            <h5 class="card-header text-primary">Add Kost</h5>
            <hr class="my-0" />
            <div class="card-body">
                <form action="{{ route('kost-store') }}" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="user_id" class="form-label">Owner Kos</label>
                            <select id="user_id" class="select2 form-select" name="user_id">
                                <option value="">Select</option>
                                @foreach ($users as $item)
                                    @if ($item->role == 'Owner')
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Nama Kost</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Fullname"
                                autofocus />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="room" class="form-label">Jumlah Kamar</label>
                            <input type="number" class="form-control" id="room" name="room"
                                placeholder="Jumlah kamar" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="picture" class="form-label">Foto Kos</label>
                            <input class="form-control" type="file" id="picture" name="file">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-sm btn-primary me-2">Add</button>
                        <button type="reset" class="btn btn-sm btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection
