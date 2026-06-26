@extends('layouts.landing')

@section('content')
<div class="bg-slate-50 font-sans antialiased text-slate-900">

    @include('components.landing.hero')
    @include('components.landing.about')
    @include('components.landing.visi-misi')
    @include('components.landing.safety')
    @include('components.landing.services')
    @include('components.landing.fleet')
    @include('components.landing.clients')

</div>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 40s linear infinite;
    }
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection