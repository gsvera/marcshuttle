@extends('admin.layouts.layout')
@section('content')
    <h1 class="mx-4">Bienvenido {{request()->session()->get('name_user')}}</h1>
    <div id="div-chart"></div>
@endsection
