@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Gallery Roope.id</h1>
    
    <div class="row">
        @foreach($galleries as $gallery)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $gallery->title }}</h5>
                    @if($gallery->description)
                    <p class="card-text">{{ $gallery->description }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        
        @if($galleries->count() == 0)
        <div class="col-12 text-center py-5">
            <h3>Belum ada gallery</h3>
            <p>Gallery akan segera diupdate.</p>
        </div>
        @endif
    </div>
</div>
@endsection