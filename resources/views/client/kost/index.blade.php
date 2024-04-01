@extends('admin.layouts.app')

@section('title', 'Client Kost')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @foreach ($kosts as $item)
                <div class="col col-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $item->rUser->name }}</h6>
                            <img class="img-fluid d-flex mx-auto my-4 rounded"
                                src="{{ asset('dist-admin/assets/img/kost1.png') }}" alt="Card image cap" />
                            <p class="card-text">{{ $item->alamat }}</p>
                            <p class="card-text">{{ $item->rUser->hp }}</p>
                            <a href="{{ route('roomClient-show', [$item->id]) }}" class="btn btn-outline-primary">Go to
                                kost</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
