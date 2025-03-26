<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEOMeta::generate() !!}

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- CSS file -->
    <link rel="stylesheet" href="{{asset('assets/scss/style.css')}}">
</head>
<body>

<div class="wrapper">

    <!-- Header -->
    <header class="header position-fixed start-0 pt-4 w-100 @if(Route::currentRouteName() !== 'index') default @endif">
        <div class="container header-container d-flex align-items-stretch justify-content-between gap-3">
            <div class="header-left d-flex align-items-center justify-content-between w-100">
                <a href="/" class="header-logo text-uppercase">
                    <img src="{{asset('storage/' . $siteInfo['header']['logo1'])}}" alt="">
                    <img src="{{asset('storage/' . $siteInfo['header']['logo2'])}}" alt="">
                </a>
                <ul class="header-navs d-flex align-items-center">
                    @foreach($siteInfo['header']['link'] as $value)
                        <li>
                            <a href="{{$value['link']}}">{{__($value['name'])}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="header-left__content d-flex align-items-center">
                    <button class="search-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.5 14H14.71L14.43 13.73C15.0549 13.0039 15.5117 12.1487 15.7675 11.2256C16.0234 10.3024 16.072 9.33413 15.91 8.38998C15.44 5.60998 13.12 3.38997 10.32 3.04997C9.33559 2.92544 8.33576 3.02775 7.397 3.34906C6.45824 3.67038 5.60542 4.20219 4.90381 4.90381C4.20219 5.60542 3.67038 6.45824 3.34906 7.397C3.02775 8.33576 2.92544 9.33559 3.04997 10.32C3.38997 13.12 5.60997 15.44 8.38997 15.91C9.33413 16.072 10.3024 16.0234 11.2256 15.7675C12.1487 15.5117 13.0039 15.0549 13.73 14.43L14 14.71V15.5L18.25 19.75C18.66 20.16 19.33 20.16 19.74 19.75C20.15 19.34 20.15 18.67 19.74 18.26L15.5 14ZM9.49997 14C7.00997 14 4.99997 11.99 4.99997 9.49997C4.99997 7.00997 7.00997 4.99997 9.49997 4.99997C11.99 4.99997 14 7.00997 14 9.49997C14 11.99 11.99 14 9.49997 14Z"
                                fill="white"/>
                        </svg>
                    </button>
{{--                    <livewire:components.switcher-language />--}}
                    <button class="bars align-items-center justify-content-center rounded-circle">
                        <img src="{{asset('assets/images/bars.svg')}}" alt="">
                        <img src="{{asset('assets/images/times-blue.svg')}}" alt="">
                    </button>
                </div>
            </div>
            <ul class="header-right d-flex align-items-center">
                @foreach($siteInfo['header']['social'] as $value)
                    <li>
                        <a href="{{$value['link']}}"
                           class="d-flex align-items-center justify-content-center rounded-circle">
                            {!! $value['logo'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </header>
    <!-- Header end -->

    <!-- Mobile menu -->
    <section class="mobile-menu">
        <img src="{{asset('assets/images/mobile-menu-bg.png')}}" alt="" class="mobile-menu__bg">
        <div class="container mobile-menu__container d-flex flex-column align-items-center">
            <ul class="mobile-menu__navs d-flex flex-column align-items-center">
                @foreach($siteInfo['header']['link'] as $value)
                    <li>
                        <a href="{{$value['link']}}">{{__($value['name'])}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="mobile-menu__search">
                <input type="text" placeholder="Поиск">
                <button>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.5 14H14.71L14.43 13.73C15.0549 13.0039 15.5117 12.1487 15.7675 11.2256C16.0234 10.3024 16.072 9.33413 15.91 8.38998C15.44 5.60998 13.12 3.38997 10.32 3.04997C9.33559 2.92544 8.33576 3.02775 7.397 3.34906C6.45824 3.67038 5.60542 4.20219 4.90381 4.90381C4.20219 5.60542 3.67038 6.45824 3.34906 7.397C3.02775 8.33576 2.92544 9.33559 3.04997 10.32C3.38997 13.12 5.60997 15.44 8.38997 15.91C9.33413 16.072 10.3024 16.0234 11.2256 15.7675C12.1487 15.5117 13.0039 15.0549 13.73 14.43L14 14.71V15.5L18.25 19.75C18.66 20.16 19.33 20.16 19.74 19.75C20.15 19.34 20.15 18.67 19.74 18.26L15.5 14ZM9.49997 14C7.00997 14 4.99997 11.99 4.99997 9.49997C4.99997 7.00997 7.00997 4.99997 9.49997 4.99997C11.99 4.99997 14 7.00997 14 9.49997C14 11.99 11.99 14 9.49997 14Z"
                            fill="#0090C7"/>
                    </svg>
                </button>
            </div>
            <ul class="mobile-menu__network d-flex align-items-center">
                @foreach($siteInfo['header']['social'] as $value)
                    <li>
                        <a href="{{$value['link']}}"
                           class="d-flex align-items-center justify-content-center rounded-circle">
                            {!! $value['logo'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <!-- Mobile menu end -->

    <!-- Search modal -->
    <livewire:components.search />
    <!-- Search modal end -->

    <!-- Date modal -->
{{--    <livewire:components.date-modal />--}}
    <!-- Date modal end -->

    <!-- Video modal -->
{{--    <livewire:components.video-modal />--}}
    <!-- Video modal end -->

    <!-- Than modal -->
    <div class="modal thank-modal fade" id="thankModal" tabindex="-1" aria-labelledby="thankModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-white align-items-start">
                <img src="{{asset('assets/images/thanks-modal-bg.png')}}" alt="" class="bg-img">
                <h2>{{__('Ваша заявка была отправлена!')}}</h2>
                <button class="d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="modal"
                        aria-label="Close">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8.00031 9.41391L13.6573 15.0709C13.8459 15.2531 14.0985 15.3539 14.3607 15.3516C14.6229 15.3493 14.8737 15.2441 15.0591 15.0587C15.2445 14.8733 15.3497 14.6225 15.352 14.3603C15.3543 14.0981 15.2535 13.8455 15.0713 13.6569L9.41431 7.99991L15.0713 2.34291C15.2535 2.1543 15.3543 1.9017 15.352 1.6395C15.3497 1.37731 15.2445 1.1265 15.0591 0.941087C14.8737 0.755679 14.6229 0.65051 14.3607 0.648231C14.0985 0.645953 13.8459 0.746747 13.6573 0.928905L8.00031 6.58591L2.34331 0.928905C2.15386 0.75125 1.90272 0.654271 1.64304 0.658487C1.38336 0.662704 1.1355 0.767787 0.951921 0.951499C0.768338 1.13521 0.663431 1.38314 0.659398 1.64283C0.655365 1.90251 0.752522 2.15358 0.930311 2.34291L6.58631 7.99991L0.929311 13.6569C0.833801 13.7492 0.757619 13.8595 0.70521 13.9815C0.652801 14.1035 0.625215 14.2347 0.624061 14.3675C0.622907 14.5003 0.648209 14.632 0.69849 14.7549C0.748771 14.8778 0.823024 14.9894 0.916916 15.0833C1.01081 15.1772 1.12246 15.2514 1.24536 15.3017C1.36825 15.352 1.49993 15.3773 1.63271 15.3762C1.76549 15.375 1.89671 15.3474 2.01872 15.295C2.14072 15.2426 2.25106 15.1664 2.34331 15.0709L8.00031 9.41391Z"
                              fill="white"/>
                    </svg>
                </button>
                <p>{{__('В течении нескольких минут, менеджер свяжется с вами и ответит на все ваши вопросы')}}</p>
                <a href="#" class="btn_white" data-bs-dismiss="modal" aria-label="Close">{{__('Хорошо!')}}</a>
            </div>
        </div>
    </div>
    <!-- Than modal end -->

    <!-- Book tour -->
    <livewire:components.book-tour />
    <!-- Book tour end -->

    <!-- Tour modal -->
    <livewire:components.tour-modal />
    <!-- Tour modal end -->

    <!-- Nutrition -->
    <livewire:components.nutrition />
    <!-- Nutrition end -->

    <!-- Day modal -->
    <livewire:components.day-modal />
    <!-- Day modal end -->

    @yield('slot') {{-- Для страниц ошибок --}}
    {{ $slot ?? '' }}

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-head d-flex align-items-start justify-content-between">
                <div class="footer-logo__wrap">
                    <a href="/" class="footer-logo">
                        <img src="{{asset('storage/' . $siteInfo['footer']['logo'])}}" alt="">
{{--                        <span>{{__($siteInfo['footer']['logo'])}}</span>--}}
                    </a>
                    <ul class="d-flex flex-wrap align-items-center">
                        @foreach($siteInfo['footer']['logos'] as $value)
                            <li>
                                <a href="#">
                                    <img src="{{asset('storage/' . $value['logo'])}}" alt="">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div
                    class="footer-content d-none d-xl-flex align-items-start justify-content-between justify-content-xl-start">
                    <div>
                        <h3>{{__($siteInfo['footer']['address'])}}</h3>
                        <p>{{__($siteInfo['footer']['address_description'])}}</p>
                    </div>
                    <div>
                        <h3>{{__($siteInfo['footer']['time'])}}</h3>
                        {!! $siteInfo['footer']['time_description'] !!}
                    </div>
                    <div>
                        <div class="mb-4">
                            <h3>E-mail:</h3>
                            <a href="mailto:{{__($siteInfo['footer']['email'])}}"
                               target="_blank">{{__($siteInfo['footer']['email'])}}</a>
                        </div>
                        <div>
                            <h3>{{__('Телефон:')}}</h3>
                            <a href="tel:{{__($siteInfo['footer']['phone'])}}">{{__($siteInfo['footer']['phone'])}}</a>
                        </div>
                    </div>
                </div>
                <div class="d-xl-none address">
                    <h3>{{__($siteInfo['footer']['address'])}}</h3>
                    <p>{{__($siteInfo['footer']['address_description'])}}</p>
                </div>
                <div class="d-xl-none time">
                    <h3>{{__($siteInfo['footer']['time'])}}</h3>
                    {!! $siteInfo['footer']['time_description'] !!}
                </div>
                <div class="d-xl-none mail">
                    <h3>E-mail:</h3>
                    <a href="mailto:{{__($siteInfo['footer']['email'])}}"
                       target="_blank">{{__($siteInfo['footer']['email'])}}</a>
                </div>
                <div class="d-xl-none phone">
                    <h3>{{__('Телефон:')}}</h3>
                    <a href="tel:{{__($siteInfo['footer']['phone'])}}">{{__($siteInfo['footer']['phone'])}}</a>
                </div>
                <ul class="footer-network d-flex align-items-center">
                    @foreach($siteInfo['header']['social'] as $value)
                        <li>
                            <a href="{{$value['link']}}"
                               class="d-flex align-items-center justify-content-center rounded-circle">
                                {!! $value['logo'] !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex">

            </div>
            <div class="footer-bottom d-flex align-items-center justify-content-between flex-column flex-sm-row gap-3">
                <ul class="d-flex align-items-center align-items-sm-start align-items-lg-center flex-column flex-lg-row">
                    <li>
                        <a href="{{ route('private-policy') }}" class="text-link">
                            <p>{{ __('Политика конфиденциальности') }}</p>
                        </a>

                    </li>
                    <li>
                        <a href="{{ route('user-agreement') }}" class="text-link">
                        <p>{{__('Пользовательское соглашение об обработке')}}</p>
                        </a>
                    </li>
                </ul>
                <p>©2024 {{__('Все права защищены')}}</p>
            </div>
        </div>
    </footer>
    <!-- Footer end -->

</div>

<!-- iMask JS file -->
<script src="{{asset('assets/js/iMask.js')}}"></script>
<!-- Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- JS file -->
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>
