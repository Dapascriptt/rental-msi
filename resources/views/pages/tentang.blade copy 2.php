@extends('layouts.landing')

@section('content')

    {{-- 1. Styles Khusus Landing Page --}}
    <x-landing_2.styles />

    <div class="bg-slate-50 overflow-x-hidden">
        {{-- 2. Hero Section --}}
        <x-landing_2.hero />

        {{-- 3. About Company --}}
        <x-landing_2.about />

        {{-- 4. Vision & Mission --}}
        <x-landing_2.visi-misi />

        {{-- 5. Main Services --}}
        <x-landing_2.services />

        {{-- 6. Equipment Ready --}}
        <x-landing_2.fleet />

        {{-- 7. Safety & Certification --}}
        <x-landing_2.safety />

        {{-- 8. Clients & Experience --}}
        <x-landing_2.clients />

        {{-- 9. Footer CTA --}}
        <x-landing_2.footer />
    </div>

    {{-- 10. Scripts Khusus Landing Page --}}
    <x-landing_2.scripts />

@endsection