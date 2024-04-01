@extends('admin.layouts.app')

@section('title', 'Client Room')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @foreach ($rooms as $item)
                <div class="col col-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->rKost->name }}</h5>
                            <h6 class="card-subtitle text-muted">Nomor Kamar : {{ $item->room_number }}</h6>
                            <img class="img-fluid d-flex mx-auto my-4 rounded"
                                src="{{ asset('dist-admin/assets/img/kamar1.webp') }}" alt="Card image cap" />
                            <p class="card-text">Harga : Rp.{{ $item->price }}</p>
                            <p class="card-text">{{ $item->status }}</p>
                            <a href="" class="btn btn-outline-primary">Reservasi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
