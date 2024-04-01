@extends('admin.layouts.app')

@section('title', 'Add Room')

@section('main-content')
    <div class="container flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Rooms /</span> Add Room</h4>
        <div class="card mb-4">
            <h5 class="card-header text-primary">Add Room</h5>
            <hr class="my-0" />
            <div class="card-body">
                <form action="{{ route('room-store') }}" id="formAccountSettings" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="kost_id" class="form-label">Nama Kos</label>
                            <select id="kost_id" class="select2 form-select" name="kost_id">
                                <option value="">Select</option>
                                @foreach ($kosts as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="roomNumber" class="form-label">Nomor kamar</label>
                            <input class="form-control" type="number" id="roomNumber" name="roomNumber"
                                placeholder="Nomor Kamar" autofocus />
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
                            <label for="price" class="form-label">Harga Kamar</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="ex: 400000" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="status" class="form-label">Status Kamar</label>
                            <select id="status" class="select2 form-select" name="status">
                                <option value="">Select</option>
                                <option value="Terisi">Terisi</option>
                                <option value="Kosong">Kosong</option>
                            </select>
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
