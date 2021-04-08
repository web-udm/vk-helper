@extends('layouts.base')

@section('title', 'Ошибка')

@section('content')
    <p>Ты сломала сервер</p>
    <img src={{ $shibaImg }}>
@endsection
