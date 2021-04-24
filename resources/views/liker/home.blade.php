@extends('layouts.base')

@section('title', 'Лайкер постов')

@section('content')
    <section class="title">
        <div class="container main-container">
            <a href="/"><h1 class="display-1">Лайкер постов ❣💩</h1></a>
            <main>
            </main>
        </div>
    </section>

    <section class="main-form">
        <div class="row justify-content-center">
            @if (session()->has('gotToken'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('gotToken') }}
                </div>
            @endif
            <a class="result-link" href="/liker/result">Страница результатов</a>
            <form class="col-lg-9" method="post" action="/liker/addTask">
                @csrf
                <p class="main-form__description">
                    Чтобы пролайкать посты - вставь ссылки на группы в форму ниже.
                    Потом выбери кол-во постов, которые будем лайкать
                </p>
                <textarea class="form-control" rows="7" name="vk_links"></textarea>
                <label>
                    Максимальное кол-во лайков
                    <select class="form-select main-form__posts-count" name="max_likes">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                        <option value="5">7</option>
                        <option value="5">8</option>
                        <option value="5">9</option>
                        <option value="5">10</option>
                        <option value="5">11</option>
                        <option value="5">12</option>
                        <option value="5">13</option>
                        <option value="5">14</option>
                        <option value="5">15</option>
                    </select>
                </label><br>
                <input class="main-form__button btn btn-success" type="submit" value="Получить помощь 🐶">
            </form>
            <form class="main-form__token-form" action="/set-vk-token">
                <a type="button" class="main-form__token-link btn btn-primary"
                   href="/get-vk-token">
                    Получить токен
                </a>
                <input type="text" class="form-input" name="vk_token">
                <input type="submit" class="btn btn-info" value="Отправить токен">
            </form>
        </div>
    </section>
@endsection
