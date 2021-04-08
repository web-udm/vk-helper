@extends('layouts.base')

@section('title', 'Ошибка')

@section('content')
    <p>Бубчи, что-то пошло не так. Если ничего не понимаешь - перешли мне:</p>
    <p><b>{{ $error_message }}</b></p>
@endsection
