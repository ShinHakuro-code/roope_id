@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4">Tentang Roope.id</h1>
                    
                    <div class="text-center mb-4">
                        <h2>{{ $aboutData['name'] }}</h2>
                        <p class="lead">{{ $aboutData['description'] }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>📍 Lokasi</h4>
                            <p>{{ $aboutData['location'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>📱 Instagram</h4>
                            <p>{{ $aboutData['instagram'] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4>🛍️ Jenis Produk</h4>
                        <ul>
                            @foreach($aboutData['products'] as $product)
                            <li>{{ $product }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h4>⭐ Keunggulan</h4>
                        <ul>
                            @foreach($aboutData['advantages'] as $advantage)
                            <li>{{ $advantage }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <h5>💡 Info Penting</h5>
                        <p class="mb-0">Roope.id menerima pesanan custom sesuai dengan kebutuhan dan tema acara Anda. Hubungi kami melalui Instagram untuk konsultasi dan pemesanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection