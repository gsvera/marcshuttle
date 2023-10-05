@extends('admin.layouts.layout')
@section('content')
    <h1 class="m-4">Bienvenido {{request()->session()->get('name_user')}}</h1>
@endsection
