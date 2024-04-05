@extends('admin.layouts.app')

@section('title', 'Edit Room-Owner')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Kosts /</span> Edit Room</h4>
        <div class="card mb-4">
            <h5 class="card-header text-primary">Edit Room</h5>
            <hr class="my-0" />
            <div class="card-body">
                <form action="{{ route('roomOwner-update', $edit->id) }}" id="formAccountSettings" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="kost_id" class="form-label">Nama Kos</label>
                            <select id="kost_id" class="select2 form-select" name="kost_id">
                                <option value="">Select</option>
                                @foreach ($kosts as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $edit->kost_id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="roomNumber" class="form-label">Nomor kamar</label>
                            <input class="form-control" type="number" id="roomNumber" name="roomNumber"
                                placeholder="Nomor Kamar" value="{{ $edit->room_number }}" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="fasilitas" class="form-label">Fasilitas kamar</label>
                            <textarea name="fasilitas" id="fasilitas" rows="10" class="form-control"
                                placeholder="Tuliskan fasilitas yang ada di kamar ini...">{{ $edit->fasilitas }}</textarea>
                        </div>
                        @php
                            $path_photo = asset('storage/images/rooms/' . $edit->file);
                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                        @endphp

                        <div class="mb-3 col-md-12">
                            <label for="alamat" class="form-label">Foto Kos</label><br>
                            <img src="{{ $path_photo }}" alt="">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="alamat" class="form-label">Ganti Foto Kos</label><br>
                            <input class="form-control" type="file" id="picture" name="file">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="price" class="form-label">Harga Kamar</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="ex: 400000" value="{{ $edit->price }}" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="status" class="form-label">Status Kamar</label>
                            <select id="status" class="select2 form-select" name="status">
                                <option value="">Select</option>
                                <option value="Terisi" @if ($edit->status == 'Terisi') selected @endif>Terisi</option>
                                <option value="Kosong" @if ($edit->status == 'Kosong') selected @endif>Kosong</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2 btn-sm">Update</button>
                        <button type="reset" class="btn btn-outline-secondary btn-sm">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
    </div>
@endsection
