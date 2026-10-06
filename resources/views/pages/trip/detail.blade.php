@extends('layouts.app')

@section('content')

    <x-banner
        breadcrumb="Trip"
        name="Trip Bogor"
        location="Kota Tegal"
        status="Open"
        openTime="24 Hours"
        :show-action="true"
    />

    @include('components.trip.detail-trip')

@endsection