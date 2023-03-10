

@extends('template.base-sb2')

@section('title')
    {{ $info->nama_web }} - Dashboard
@stop

@section('css')

@stop


@section('page-content')

<div class="bg-light p-5 rounded border">

    <h3>Selamat Datang di dashboard {{auth()->user()->name}}!</h3>

</div>

@stop

@section('script')   

@stop