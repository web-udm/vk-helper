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
            <form class="col-lg-9" method="post" action="/liker/result">
                @csrf
                <p class="main-form__description">
                    Чтобы пролайкать посты - вставь ссылки на группы в форму ниже.
                    Потом выбери кол-во постов последних постов, которые будем лайкать
                </p>
                <textarea class="form-control" rows="7" name="vk_links"></textarea>
                <label>
                    Кол-во постов
                    <select class="form-select main-form__posts-count" name="posts_number">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="миллион">миллион</option>
                    </select>
                </label><br>
                <input class="main-form__button btn btn-success" type="submit" value="Получить помощь 🐶">
            </form>
            @if(env('APP_ENV') == 'local')
                <form action="/set-vk-token">
                    <input type="text" class="form-input" name="vk_token">
                    <input type="submit" class="btn">
                </form>
            @endif
            <a type="button" class="main-form__token-link btn btn-primary"
               href="/get-vk-token">
                Получить токен
            </a>
        </div>
    </section>
@endsection
