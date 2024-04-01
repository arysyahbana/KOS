@extends('admin.layouts.app')

@section('title', 'Edit Kost')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Kosts /</span> Edit Kost</h4>
        <div class="card mb-4">
            <h5 class="card-header text-primary">Edit Kost</h5>
            <hr class="my-0" />
            <div class="card-body">
                <form action="{{ route('kost-update', $edit->id) }}" id="formAccountSettings" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="user_id" class="form-label">Owner Kos</label>
                            <select id="user_id" class="select2 form-select" name="user_id">
                                <option value="">Select</option>
                                @foreach ($users as $item)
                                    @if ($item->role == 'Owner')
                                        <option value="{{ $item->id }}"
                                            @if ($item->id) selected @endif>{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Nama Kost</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Fullname"
                                autofocus value="{{ $edit->name }}" />
                        </div>
                        {{-- <div class="mb-3 col-md-12">
                            <label class="form-label" for="hp">Nomor HP</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">IND (+62)</span>
                                <input type="text" id="hp" name="hp" class="form-control"
                                    placeholder="811 2222 3434" />
                            </div>
                        </div> --}}
                        <div class="mb-3 col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                value="{{ $edit->alamat }}" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="room" class="form-label">Jumlah Kamar</label>
                            <input type="number" class="form-control" id="room" name="room"
                                placeholder="Jumlah kamar" value="{{ $edit->rooms }}" />
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
