@extends('layouts.app')

@section('content')

    <x-banner
        breadcrumb="Sewa Villa"
        name="Villa Harmoni Tegal"
        location="Kota Tegal"
        status="Open"
        openTime="24 Hours"
        :show-action="true"
    />

    @include('components.villa.detail-villa')

@endsection