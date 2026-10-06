@extends('layouts.app')

@section('content')

    <x-banner
        breadcrumb="Sewa Villa"
        name="{{ $data['name'] }}"
        location="{{ $data['location'] ?? $data['address'] }}"
        status="Open"
        openTime="24 Hours"
        :show-action="true"
    />

    @include('components.villa.detail-villa')

@endsection