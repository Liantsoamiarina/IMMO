@extends("admin.layouts.Admin")
@section("body")
@section("style")
<link rel="stylesheet" href="{{ asset("assets/css/createproperty.css") }}">
@endsection
@livewire("create-property")
@endsection
