@extends("admin.layouts.Admin")
@section("body")
@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/property.css') }}">
@endsection

@livewire("properties")
@endsection('body')
