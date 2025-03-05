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
                <a href="/" class="header-logo text-uppercase"></a>
{{--                @dd($siteInfo['header'])--}}
                <a href="/" class="header-logo text-uppercase">
                    <img src="{{asset('storage/' . $siteInfo['header']['logo'])}}">
{{--                    <svg width="156" height="16" viewBox="0 0 156 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M3.86222 15H0.566761L8.00284 0.454545H11.9659L14.5653 15H11.2699L9.50142 3.77841H9.38778L3.86222 15ZM4.61506 9.28267H12.3991L11.9872 11.6832H4.20312L4.61506 9.28267ZM27.1109 5.15625C27.073 4.81061 26.9925 4.50521 26.8694 4.24006C26.751 3.97017 26.5877 3.7429 26.3793 3.55824C26.171 3.36884 25.9177 3.22443 25.6194 3.125C25.3211 3.02557 24.9754 2.97585 24.5825 2.97585C23.8391 2.97585 23.1431 3.16051 22.4944 3.52983C21.8504 3.89915 21.3012 4.43655 20.8467 5.14205C20.3921 5.8428 20.082 6.69981 19.9163 7.71307C19.7458 8.72633 19.7458 9.58807 19.9163 10.2983C20.0915 11.0085 20.4205 11.5507 20.9035 11.9247C21.3912 12.294 22.0185 12.4787 22.7856 12.4787C23.4816 12.4787 24.1066 12.3556 24.6606 12.1094C25.2146 11.8584 25.6667 11.5057 26.0171 11.0511C26.3722 10.5966 26.5995 10.0592 26.6989 9.43892L27.3097 9.53125H23.5668L23.9504 7.21591H30.037L29.7245 9.0483C29.5209 10.3267 29.0735 11.4252 28.3822 12.3438C27.6909 13.2623 26.8291 13.9678 25.7969 14.4602C24.7695 14.9527 23.6426 15.1989 22.4163 15.1989C21.0526 15.1989 19.9044 14.8982 18.9717 14.2969C18.0436 13.6908 17.3831 12.8314 16.9901 11.7188C16.6019 10.6013 16.5332 9.27557 16.7842 7.74148C16.9783 6.5625 17.3239 5.51136 17.8211 4.58807C18.323 3.66004 18.9362 2.87405 19.6606 2.23011C20.385 1.58617 21.1876 1.09612 22.0683 0.759943C22.9537 0.423768 23.8746 0.255681 24.831 0.255681C25.6549 0.255681 26.4006 0.37642 27.0683 0.617898C27.7406 0.85464 28.3159 1.19081 28.7941 1.62642C29.2771 2.06203 29.6416 2.58049 29.8879 3.18182C30.1388 3.77841 30.2548 4.43655 30.2359 5.15625H27.1109ZM39.3936 6.52699L39.003 8.92756H32.3624L32.753 6.52699H39.3936ZM55.2115 5.54688H52.1433C52.1528 5.13968 52.1007 4.77983 51.9871 4.46733C51.8734 4.15009 51.703 3.88021 51.4757 3.65767C51.2532 3.43513 50.9809 3.26705 50.6589 3.15341C50.337 3.03504 49.9748 2.97585 49.5723 2.97585C48.7958 2.97585 48.0832 3.16998 47.4345 3.55824C46.7858 3.9465 46.239 4.50994 45.7939 5.24858C45.3488 5.98248 45.041 6.87026 44.8706 7.91193C44.7049 8.91572 44.7143 9.75616 44.899 10.4332C45.0837 11.1103 45.4104 11.6217 45.8791 11.9673C46.3526 12.3082 46.9421 12.4787 47.6476 12.4787C48.0832 12.4787 48.4975 12.4242 48.8905 12.3153C49.2835 12.2017 49.641 12.0407 49.9629 11.8324C50.2896 11.6193 50.5737 11.3613 50.8152 11.0582C51.0614 10.7552 51.2532 10.4119 51.3905 10.0284H54.48C54.2858 10.696 53.9828 11.34 53.5709 11.9602C53.1637 12.5805 52.6594 13.1345 52.0581 13.6222C51.4568 14.1051 50.7726 14.4886 50.0055 14.7727C49.2385 15.0568 48.3981 15.1989 47.4842 15.1989C46.1632 15.1989 45.0292 14.8958 44.0822 14.2898C43.14 13.6837 42.4606 12.8101 42.0439 11.669C41.6272 10.5279 41.5491 9.15246 41.8095 7.54261C42.0699 5.98485 42.5789 4.66383 43.3365 3.57955C44.0988 2.49053 45.0245 1.6643 46.1135 1.10085C47.2072 0.537405 48.3768 0.255681 49.622 0.255681C50.4885 0.255681 51.2721 0.374053 51.9729 0.610795C52.6736 0.847538 53.2702 1.19318 53.7626 1.64773C54.2598 2.09754 54.6339 2.64915 54.8848 3.30256C55.1357 3.95597 55.2446 4.70407 55.2115 5.54688ZM56.0614 15L58.4761 0.454545H61.5514L60.5571 6.45597H66.8L67.7943 0.454545H70.8625L68.4477 15H65.3795L66.3739 8.99148H60.131L59.1366 15H56.0614ZM82.5824 0.454545H85.6577L84.0952 9.90057C83.92 10.9612 83.5152 11.8892 82.8807 12.6847C82.2462 13.4801 81.4389 14.1004 80.4588 14.5455C79.4787 14.9858 78.3849 15.206 77.1776 15.206C75.9702 15.206 74.9522 14.9858 74.1236 14.5455C73.295 14.1004 72.696 13.4801 72.3267 12.6847C71.9574 11.8892 71.8603 10.9612 72.0355 9.90057L73.598 0.454545H76.6733L75.1463 9.63778C75.0611 10.1918 75.1037 10.6842 75.2741 11.1151C75.4493 11.5459 75.7382 11.8845 76.1406 12.1307C76.5431 12.3769 77.0402 12.5 77.6321 12.5C78.2287 12.5 78.7685 12.3769 79.2514 12.1307C79.7391 11.8845 80.1392 11.5459 80.4517 11.1151C80.7689 10.6842 80.9702 10.1918 81.0554 9.63778L82.5824 0.454545ZM85.9731 15L88.3879 0.454545H91.4631L90.4049 6.8679H90.5967L96.8893 0.454545H100.575L94.1194 6.96733L98.2245 15H94.5455L91.5768 9.01989L89.7444 10.8807L89.0484 15H85.9731ZM113.687 7.92614C113.422 9.47917 112.908 10.7978 112.146 11.8821C111.389 12.9664 110.463 13.7902 109.369 14.3537C108.28 14.9171 107.106 15.1989 105.846 15.1989C104.525 15.1989 103.387 14.8982 102.43 14.2969C101.478 13.6955 100.79 12.8267 100.363 11.6903C99.9373 10.5492 99.8568 9.17377 100.122 7.56392C100.378 6.00616 100.887 4.68513 101.649 3.60085C102.411 2.51184 103.342 1.68324 104.44 1.11506C105.539 0.54214 106.72 0.255681 107.984 0.255681C109.296 0.255681 110.427 0.558712 111.379 1.16477C112.335 1.77083 113.024 2.64678 113.446 3.79261C113.872 4.93371 113.952 6.31155 113.687 7.92614ZM110.626 7.56392C110.792 6.56487 110.785 5.7268 110.605 5.04972C110.43 4.3679 110.108 3.8518 109.639 3.50142C109.17 3.15104 108.578 2.97585 107.863 2.97585C107.087 2.97585 106.374 3.16998 105.726 3.55824C105.082 3.9465 104.537 4.50994 104.092 5.24858C103.652 5.98248 103.346 6.875 103.176 7.92614C103.005 8.92992 103.01 9.76799 103.19 10.4403C103.375 11.1127 103.704 11.6217 104.177 11.9673C104.656 12.3082 105.25 12.4787 105.96 12.4787C106.732 12.4787 107.437 12.2893 108.076 11.9105C108.72 11.527 109.263 10.9706 109.703 10.2415C110.143 9.50758 110.451 8.61506 110.626 7.56392ZM115.757 2.99006L116.183 0.454545H128.129L127.703 2.99006H123.25L121.261 15H118.221L120.21 2.99006H115.757ZM127.882 15L130.296 0.454545H133.372L132.313 6.8679H132.505L138.798 0.454545H142.484L136.028 6.96733L140.133 15H136.454L133.485 9.01989L131.653 10.8807L130.957 15H127.882ZM144.378 15H141.082L148.518 0.454545H152.482L155.081 15H151.786L150.017 3.77841H149.903L144.378 15ZM145.131 9.28267H152.915L152.503 11.6832H144.719L145.131 9.28267Z" fill="white"/>--}}
{{--                    </svg>--}}
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
                    <livewire:components.switcher-language />
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
                        <span>{{__($siteInfo['footer']['logo'])}}</span>
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
