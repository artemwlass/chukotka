<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <a href="{{route('blog')}}">{{__('Блог')}}</a>
                <span>/</span>
                <span class="text-blue">{{__($data->title)}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Article home -->
        <section class="article-home">
            <div class="container article-home__container d-flex flex-column justify-content-between text-white">
                <div class="main-img">
                    <img src="{{asset('storage/' . $data->image)}}" alt="" class="article-home__bg">
                </div>
                <ul class="alerts d-flex flex-wrap align-items-center">
                    @foreach($data->tags as $value)
                        <li class="{{__($value['color'])}}">{{__($value['title'])}}</li>
                    @endforeach
                </ul>
                <div>
                    <ul class="datas d-flex align-items-center flex-wrap">
                        <li class="d-flex align-items-center gap-2">
                            <img src="{{asset('assets/images/calendar-icon.svg')}}" alt="">
                            <span>{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y') }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="{{asset('assets/images/eye-icon.svg')}}" alt="">
                            <span>{{$data->views}}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <img src="{{asset('assets/images/user-icon.svg')}}" alt="">
                            <span>{{__($data->author)}}</span>
                        </li>
                    </ul>
                    <h3>{{__($data->title)}}</h3>
                </div>
            </div>
        </section>
        <!-- Article home end -->

        <!-- Article -->
        <section class="article">
            <div class="container">
                <div class="article-content d-flex flex-column">
                    <div class="article-content__item d-flex flex-column align-items-start img-border">
                        {!! __($data->description) !!}
                    </div>
                    @if($recommend)
                        <div class="article-content__item d-flex flex-column align-items-start w-100">
                            <div class="main-card d-flex align-items-stretch justify-content-between w-100">
{{--                                <img src="{{asset('assets/images/article-main-card-bg.png')}}" alt="" class="bg-img">--}}
                                <div class="d-flex flex-column justify-content-between align-items-start">
                                    <h4>{{__('Рекомендуем тур')}}</h4>
                                    <div class="w-100">
                                        <h3>{{__($recommend->title)}}</h3>
                                        <a href="{{route('tour', ['slug' => $recommend->slug])}}" class="btn_white">{{__('Подробнее')}}</a>
                                    </div>
                                </div>
                                <img src="{{asset('storage/' . $recommend->main_image)}}" alt="">
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        <!-- Article end -->
        <!-- Article -->
        <section class="article">
            <div class="container">
                <div class="article-content d-flex flex-column">
                    <div class="article-content__item d-flex flex-column align-items-start img-border">
                        {!! __($data->description_2) !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- Article end -->
        <!-- Tours -->
        <section class="tours tours-page">
            <div class="container">
                <h2>{{__('Рекомендуем посетить')}}</h2>
                <div class="row">
                    @foreach($tours as $tour)
                        @php
                            $earliestDate = $tour->bookings->min('date_from');
                            $minPrice = $tour->bookings->min('price');
                            $dateCount = count($tour->bookings)
                        @endphp
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="tours-card d-flex flex-column justify-content-between">
                            <img src="{{ asset('storage/' . $tour->main_image) }}" alt="" class="main-img">
                            <div class="tours-card__head d-flex flex-column flex-lg-row align-items-start justify-content-between">
                                <ul class="d-flex align-items-stretch rounded-pill text-white"
                                    data-bs-target="#dateModal"
                                    data-bs-toggle="modal"
                                    wire:click="$dispatch('openDateModal', { id: {{ $tour->id }} })"
                                >
                                    <li>{{ \Carbon\Carbon::parse($earliestDate)->format('d.m') }}</li>
                                    @if($dateCount > 1)
                                        <li>+{{ $dateCount }} даты</li>
                                    @endif
                                </ul>
                                <h4 class="rounded-pill">{{__('От')}} {{$minPrice}}₽</h4>
                            </div>
                            <div class="d-flex align-items-end justify-content-between">
                                <h3 class="text-uppercase text-white">{{__($tour->title)}}</h3>
                                <a href="{{route('tour', ['slug' => $tour->slug])}}" class="d-flex align-items-center justify-content-center rounded-circle">
                                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.9831 1.56529C19.0192 1.15266 18.714 0.788881 18.3014 0.75278L11.5771 0.164479C11.1644 0.128377 10.8006 0.433621 10.7645 0.846258C10.7284 1.25889 11.0337 1.62267 11.4463 1.65877L17.4235 2.1817L16.9006 8.15887C16.8645 8.57151 17.1697 8.93528 17.5823 8.97139C17.995 9.00749 18.3587 8.70224 18.3948 8.28961L18.9831 1.56529ZM1.48209 16.5372L18.7181 2.07446L17.7539 0.925393L0.517909 15.3881L1.48209 16.5372Z" fill="white"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="more-btn d-flex align-items-center justify-content-center">
                    <a href="{{route('tours')}}" class="btn_blue">{{__('Смотреть все туры')}} </a>
                </div>
            </div>
        </section>
        <!-- Tours end -->

        <!-- Request -->
        <livewire:components.no-time-to-search />
        <!-- Request end -->

    </main>
    <style>
        .img-border img {
            border-radius: 20px;
        }
    </style>
</div>
