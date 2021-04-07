@extends('layouts.base')

@section('title', 'Чекер постов')

@section('content')

<section class="main-form">
    <div class="row justify-content-center">

        {{-- @if ($gotToken)
        <div class="alert alert-success" role="alert">

        </div>
        @endif --}}

        <form class="col-lg-9" method="post" action="/results">
            <p class="ma in-form__description">
                Любчи, чтобы помочь себе - напишите ссылки, с которых нужно собрать посты, в форму ниже.
                Каждая новая ссылка - с новой строки
            </p>
            <textarea class="form-control" rows="7" name="links"></textarea>
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
            <a type="button" class="main-form__token-link btn btn-primary"
               href="https://oauth.vk.com/authorize?client_id=7751109&display=page&redirect_uri=http://webudm.beget.tech/token&scope=friends&response_type=code&v=5.126">
                Получить токен
            </a>
            <input class="main-form__button btn btn-success" type="submit" value="Получить помощь 🐶">
        </form>
    </div>
</section>

@endsection
