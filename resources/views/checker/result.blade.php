@extends('layouts.base')

@section('title', 'Посты')

@section('content')
    <section class="results">
        @foreach ($groupsData as $groupName => $groupData)
            <p type="button" class="results__group-name display-3" data-toggle="collapse"
               data-target="#{{ $groupName }}">{{ $groupName }}</p>
            @foreach ($groupData as $post)
                <div class="results__data-wrapper" id="{{ $groupName }}">
                    <div class="results__item results__time-wrapper">
                        <time> {{ date('d-m-Y H:i:s', $post['date']) }}</time>
                    </div>
                    <div class="results__item results__emojies-wrapper">
                        <p class="results__emojies-count">
                            Эмодзи:<br><span class="results__emojies-number">{{ count($post['emojies']) }}</span>
                        </p>
                        <p class="results__emojies-list">
                            @foreach ($post['emojies'] as $emoji)
                                <span>{{ $emoji }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="results__item results__hashtags-wrapper">
                        <p class="results__hashtags-count">
                            Хэштегов:<br><span class="results__hashtags-number">{{ count($post['hashtags']) }}</span>
                        </p>
                        <p class="results__hashtags-list">
                            @foreach ($post['hashtags'] as $hashtag)
                                <span>{{ $hashtag }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="results__item results__content-wrapper">
                        @if (isset($post['images']))
                            @foreach ($post['images'] as $image)
                                <img src="{{ $image }}">
                            @endforeach
                        @endif
                        <p class="results__text">{{ $post['text'] }}</p>
                    </div>
                </div>
            @endforeach
        @endforeach
    </section>
@endsection
