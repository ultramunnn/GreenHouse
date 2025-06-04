@extends('layouts.app')

@section('content')
    @include('pages.sections.hero')
    @include('pages.sections.cara-kerja')
    @include('pages.sections.misi')
    @include('pages.sections.tentang')
@endsection

@push('styles')
            <style>
    .hero-section {
        background-image: url('https://readdy.ai/api/search-image?query=A%20modern%20greenhouse%20with%20glass%20walls%20and%20ceiling%2C%20filled%20with%20lush%20green%20plants%20and%20vegetables.%20The%20image%20shows%20a%20clean%2C%20minimalist%20interior%20with%20organized%20rows%20of%20plants.%20Soft%20natural%20light%20filters%20through%20the%20glass%2C%20creating%20a%20serene%20atmosphere.%20The%20greenhouse%20has%20a%20sleek%20design%20with%20white%20structural%20elements%20and%20automated%20systems%20visible.%20The%20background%20shows%20a%20clear%20blue%20sky.&width=1600&height=800&seq=greenhouse-hero&orientation=landscape');
        background-size: cover;
        background-position: center;
    }
    .hero-overlay {
        background: linear-gradient(90deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 50%, rgba(255,255,255,0.1) 100%);
    }
            </style>
@endpush
