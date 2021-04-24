@extends('layouts.base')

@section('title', 'Результаты лайкинга')

@section('content')
    <h1> Задачи по лайкингу: </h1>
    <ul class="liking-tasks__list">
        @foreach ($likingTasks as $likingTask)
            <div class="liking-task__item-wrapper {{ $likingTask->status == 'Успешно завершено'
                                                    ? 'liking-task__item-wrapper__complete'
                                                    : 'liking-task__item-wrapper__in-process' }}">
                <div class="liking-task__item-parameter">
                    {{ $likingTask->id }}
                </div>
                <div class="liking-task__item-parameter">
                    {{ $likingTask->status }}
                </div>
                <div class="liking-task__item-parameter">
                    {{ $likingTask->date }}
                </div>
            </div>
        @endforeach
    </ul>
@endsection
