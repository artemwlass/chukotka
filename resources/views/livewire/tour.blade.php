<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <a href="#">{{__('Туры')}}</a>
                <span>/</span>
                <span class="text-blue">{{__($data->title)}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Tour home -->
        <section class="tour-home">
            <div class="container">
                <div class="tour-home__content d-flex flex-column align-items-start justify-content-between">
                    <img src="{{asset('storage/' . $data->main_image)}}" alt="" class="main-img">
                    <div class="tour-home__content-head d-flex align-items-center flex-wrap">
                        <div class="date d-flex align-items-center"
                             data-bs-toggle="modal"
                             data-bs-target="#dateModal-{{ $data->id }}"
                        >
                            <label for="">{{__('Даты заездов:')}}</label>
                            <p>
                                c {{ \Carbon\Carbon::parse($nearestBooking->date_from)->translatedFormat('d F') }}
                                по {{ \Carbon\Carbon::parse($nearestBooking->date_to)->translatedFormat('d F') }}
                            </p>
                        </div>
                        <h4>{{__('Длительность тура:')}} {{ $data->tour_duration }} {{__('дней')}}</h4>
                    </div>
                    <div>
                        <h3>
                            {{$data->price}}₽ <span>/ {{__('чел')}}</span>
                        </h3>
                        <h2>{{__($data->title)}}</h2>
                        <div class="features-list__right d-flex align-items-center btns">
                            <a href="#" class="btn_white"
                               data-bs-toggle="modal"
                               data-bs-target="#bookTour"
                               wire:click="$dispatch('openBookTour', { tourId: {{ $data->id }}, bookId: {{$data->id}} })"
                            >{{__('Забронировать тур')}}</a>
                            <a href="#" class="btn_light" data-bs-toggle="modal" data-bs-target="#tourModal">{{__('Заявка на корпоративный тур')}}</a>
                        </div>
                    </div>
                </div>
                <ul class="tour-home__list d-flex align-items-center flex-wrap justify-content-between">
                    @foreach($data->tour_specifications as $value)
                        <li class="d-flex align-items-center gap-3">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="{{asset('assets/images/peoples-icon.svg')}}" alt="">
                            </div>
                            <p>{{$value['question']}} <br> {{$value['answer']}}</p>
                        </li>
                    @endforeach

                </ul>
            </div>
        </section>
        <livewire:components.date-modal :id="$data->id" />
        <!-- Tour home end -->

        <!-- About tour -->
        <section class="about-tour">
            <div class="container about-tour__container d-flex align-items-start justify-content-between">
                <div class="about-tour__content">
                    <h2>{{__($data->title_1)}}</h2>
                    <ul class="d-flex flex-column">
                        @php
                            use Illuminate\Support\Str;
                            $description = Str::between($data->description, '<ul>', '</ul>');
                        @endphp

                        {!! $description !!}
                    </ul>
                </div>
                <div class="about-tour__swp">
                    <div class="swp-parent">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($data->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{asset('storage/' . $image)}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="swp-child">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($data->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{asset('storage/' . $image)}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About tour end -->

        <!-- Video block -->
        <section class="video-block">
            <div class="container video-block__container d-flex align-items-center justify-content-center">
                <img src="{{asset('assets/images/video-block-card.png')}}" alt="" class="main-img">
                <a href="#" class="d-flex align-items-center justify-content-center"
                   data-bs-toggle="modal"
                   data-bs-target="#videoModal"
                   wire:click="$dispatch('openVideo', { tourId: {{ $data->id }} })"
                >
                    <img src="{{asset('assets/images/play-icon.svg')}}" alt="">
                </a>
            </div>
        </section>
        <!-- Video block end -->

        <!-- Program -->
        <section class="program">
            <div class="container program-container">
                <div class="program-head d-flex align-items-center">
                    <h2>{{__('Программа тура')}}</h2>
                    <span>{{ $data->tour_duration }} {{__('дней')}}</span>
                </div>
                <div class="program-card__wrap d-flex flex-column">
                    @foreach($data->days as $day)
                    <div class="program-card">
                        <div class="day">{{$day->day}} {{__('день')}}</div>
                        <div class="name">{{__($day->title)}}</div>
                        <ul class="program-card__text d-flex flex-column">
                            @php
                                $description = Str::between($day->description, '<ul>', '</ul>');
                            @endphp

                            {!! $description !!}
                            @if($day->program_capabilities['see_more'])
                                <li>
                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#dayModal"
                                       wire:click="$dispatch('openDayModal', { dayId: {{ $day->id }} })"
                                    >{{__('Смотреть еще')}}</a>
                                </li>
                            @endif

                        </ul>
                        <div class="line"></div>
                        <div
                            class="program-card__foot d-flex flex-column flex-xl-row align-items-start align-items-xl-center justify-content-between gap-3 gap-xl-0">
                            <ul class="program-card__list d-flex align-items-center flex-wrap">
                                @foreach($day->program_capabilities['capabilities'] as $value)
                                <li class="d-flex align-items-center">
                                    <div class="icon d-flex align-items-center justify-content-center rounded-circle">
                                        <img src="{{asset('storage/' . $value['icon'])}}" alt="">
                                    </div>
                                    <p>{!! $value['title'] !!}</p>
                                </li>
                                @endforeach
                            </ul>
                            <div class="btns flex-column flex-sm-row align-items-center gap-2 gap-xl-3">
                                <a href="#" class="btn_blue"
                                   data-bs-toggle="modal"
                                   data-bs-target="#dateModal"
                                   wire:click="$dispatch('openDateModal', { id: {{ $data->id }} })"
                                >{{__('Забронировать тур')}}</a>
                                <a href="#" class="btn_orange"  data-bs-toggle="modal" data-bs-target="#tourModal">{{__('Заявка на корп. тур')}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="btn_blue more-btn">{{__('Смотреть всю программу')}}</button>
            </div>
        </section>
        <!-- Program end -->

        <!-- Galereya modal -->
        <div class="modal galereya-modal fade" id="galereyaModal" tabindex="-1" aria-labelledby="galereyaModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button class="btn_close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{asset('assets/images/times-white.svg')}}" alt="" width="20">
                    </button>
                    <button class="swp-btn swp-btn__prev">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                        </svg>
                    </button>
                    <button class="swp-btn swp-btn__next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                        </svg>
                    </button>
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($data->galleries as $image)
                                <div class="swiper-slide">
                                    <img src="{{asset('storage/' . $image)}}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Galereya modal end -->

        <!-- Galereya -->
        <section class="galereya">
            <div class="container">
                <h2>{{__('Галерея')}}</h2>
                <ul>
                    @foreach (array_slice($data->galleries, 0, 9) as $index => $image)
                        <li>
                            <img src="{{ asset('storage/' . $image) }}" alt="Фото {{ $index + 1 }}">

                            @if ($index === 3) {{-- Если 4-й элемент --}}
                            <a href="#" class="position-absolute d-flex align-items-center justify-content-center w-100 h-100"
                               data-bs-toggle="modal" data-bs-target="#galereyaModal">
                                {{__('ещё')}} {{ count($data->galleries) - 9 }} {{__('фото')}}
                            </a>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>
        </section>
        <!-- Galereya end -->

        <!-- Features -->
        <section class="features">
            <div class="features-bg"></div>

            {{--            <img src="{{asset('assets/images/features-bg.png')}}" alt="" class="features-bg">--}}
            <div class="container">
                <h2>{{__('Особенности программы:')}}</h2>
                <div class="row">
                    @foreach($data->program_capabilities as $value)
                        <div class="col-12 col-xl-4 features-card d-flex align-items-center align-items-xl-start">
                            <div class="number d-flex align-items-center justify-content-center rounded-circle">{{$loop->iteration}}</div>
                            <p>{{$value['description']}}</p>
                        </div>
                    @endforeach

                </div>
                <h3>{{__('даты бронирования')}}</h3>
                <ul class="features-list__wrap d-flex flex-column">
                    @foreach($bookings as $book)
                        <li class="features-list d-flex align-items-center justify-content-between w-100">
                            <h4>
                                {{__('С')}} {{ \Carbon\Carbon::parse($book->date_from)->translatedFormat('d F') }}
                                {{__('по')}} {{ \Carbon\Carbon::parse($book->date_to)->translatedFormat('d F Y') }}
                            </h4>
                            <div class="features-list__right d-flex align-items-center">
                                <p>{{$book->price}}₽ / <span>{{__('чел')}}</span></p>
                                <a href="#" class="btn_white"
                                   data-bs-toggle="modal"
                                   data-bs-target="#bookTour"
                                   wire:click="$dispatch('openBookTour', { tourId: {{ $data->id }}, bookId: {{$book->id}} })"
                                >{{__('Забронировать тур')}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!-- Features end -->

        <!-- Await -->
        <section class="await">
            <div class="container">
                <h2>{{__('Что вас ожидает в туре?')}}</h2>
                <div class="row">
                    @foreach($data['awaits'] as $value)
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="await-card d-flex align-items-start gap-3 h-100">
                            <img src="{{asset('assets/images/check-blue-icon.svg')}}" alt="">
                            <p>{{__($value['description'])}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Await end -->

        <!-- Take -->
        <section class="take">
            <div class="container">
                <h2>{{__('Что взять с собой?')}}</h2>
                <div class="take-content">
                    <div class="take-content__item-wrap d-flex align-items-start justify-content-between">
                        <div class="take-content__item">
                            <h3>{{__('Обязательно')}}</h3>
                            <div class="row row-gap-3">
                                <div class="col-12 col-sm-6">
                                    <ul class="checkbox-wrap d-flex flex-column">
                                        @foreach($data->take['necessarily'] as $value)
                                        <li class="checkbox d-flex align-items-center">
                                            <input type="checkbox" name="" id="">
                                            <div class="icon">
                                                <img src="{{asset('assets/images/check-white-icon.svg')}}" alt="">
                                            </div>
                                            <p>{{__($value['description'])}}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <ul class="checkbox-wrap d-flex flex-column">
                                        @foreach($data->take['necessarily_2'] as $value)
                                            <li class="checkbox d-flex align-items-center">
                                                <input type="checkbox" name="" id="">
                                                <div class="icon">
                                                    <img src="{{asset('assets/images/check-white-icon.svg')}}" alt="">
                                                </div>
                                                <p>{{__($value['description'])}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="take-content__item">
                            <h3>{{__('Желательно')}}</h3>
                            <ul class="checkbox-wrap d-flex flex-column">
                                @foreach($data->take['preferably'] as $value)
                                    <li class="checkbox d-flex align-items-center">
                                        <input type="checkbox" name="" id="">
                                        <div class="icon">
                                            <img src="{{asset('assets/images/check-white-icon.svg')}}" alt="">
                                        </div>
                                        <p>{{__($value['description'])}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="take-content__item">
                            <h3>{{__('Мы предоставляем')}}</h3>
                            @foreach($data->take['we_provide'] as $value)
                            <div class="d-flex align-items-start">
                                <img src="{{asset('assets/images/check-blue-icon.svg')}}" alt="">
                                <p>{!! __($value['description']) !!}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="take-content__foot d-flex align-items-center justify-content-between">
                        <div class="take-content__foot-left d-flex">
                            <a href="#" class="btn_blue d-flex align-items-center">
                                <img src="{{asset('assets/images/copy-icon.svg')}}" alt="">
                                <span>{{__('Скопировать')}}</span>
                            </a>
                            <a href="#" class="btn_lightblue">{{__('Распечатать')}}</a>
                        </div>
                        <a href="{{asset('storage/' . $data->take['pdf'])}}" class="btn_orange" download>
                            <img src="{{asset('assets/images/copy-icon.svg')}}" alt="">
                            <span>{{__('Скачать программу в PDF')}}</span>
                        </a>
                    </div>
                </div>
                <div class="row row-gap-3">
                    <div class="col-12 col-xl-6">
                        <div class="main-accordion">
                            <div class="main-accordion__btn d-flex align-items-center justify-content-between">
                                <p>{{__('Что входит в стоимость?')}}</p>
                                <div class="icon">
                                    <img src="{{asset('assets/images/plus-icon.svg')}}" alt="">
                                    <img src="{{asset('assets/images/times-white.svg')}}" alt="">
                                </div>
                            </div>
                            <div class="main-accordion__body">
                                <ul class="d-flex flex-column">
                                    @php
                                        $description = Str::between(__($data?->include['include']), '<ul>', '</ul>');
                                    @endphp

                                    {!! __($description) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="main-accordion">
                            <div class="main-accordion__btn d-flex align-items-center justify-content-between">
                                <p>{{__('Что не входит в стоимость?')}}</p>
                                <div class="icon">
                                    <img src="{{asset('assets/images/plus-icon.svg')}}" alt="">
                                    <img src="{{asset('assets/images/times-white.svg')}}" alt="">
                                </div>
                            </div>
                            <div class="main-accordion__body">
                                <ul class="d-flex flex-column">
                                    @php
                                        $description = Str::between(__($data?->include['not_include']), '<ul>', '</ul>');
                                    @endphp

                                    {!! __($description) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Take end -->

        <!-- Work -->
        <section class="work">
            <div class="work-bg"></div>

            {{--            <img src="{{asset('assets/images/work-block-bg.png')}}" alt="" class="work-bg">--}}
            <div class="container">
                <div class="row work-head">
                    <div class="col-12 col-xl-4">
                        <div class="work-head__card d-flex flex-column justify-content-between h-100">
                            <h3>{{__($data->first_small_block['title'])}}</h3>
                            <p>{{__($data->first_small_block['description'])}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="work-head__card d-flex flex-column justify-content-between h-100">
                            <h3>{{__($data->two_small_block['title'])}}</h3>
                            <p>{{__($data->first_small_block['description'])}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="work-head__card d-flex flex-column justify-content-between h-100">
                            <h3>{{__($data->three_small_block['title'])}}</h3>
                            <p>{{__($data->three_small_block['description'])}}</p>
                        </div>
                    </div>
                </div>
                <div class="work-body d-flex align-items-start">
                    <h2>{{__($data->big_block['title'])}}</h2>
                    <div class="work-body__content">
                       {!! __($data->big_block['description']) !!}
                    </div>
                </div>
                <div class="work-map">
                    <h3>{{__('Карта тура')}}</h3>
                    <div class="work-map__img">
                        {!! $data->map_link !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- Work end -->

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
</div>
