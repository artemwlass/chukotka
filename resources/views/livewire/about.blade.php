<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <span class="text-blue">{{__('О нас')}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- About home -->
        <section class="about-home">
            <div class="container about-home__container d-flex flex-column align-items-start justify-content-between text-white">
                <img src="{{asset('storage/' . $data->image)}}" alt="" class="main-img">
                <h2>{{$data->title[app()->getLocale()]['title']}}</h2>
                <div>
                    <img src="{{asset('assets/images/about-home-icon.svg')}}" alt="">
                    <p>{!! $data->header_description[app()->getLocale()]['description'] !!}</p>
                </div>
            </div>
        </section>
        <!-- About home end -->

        <!-- Organize block -->
        <section class="organize-block">
            <div class="container">
                <h2>{{$data->title_2[app()->getLocale()]['title']}}</h2>
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="organize-block__card h-100 text-white d-flex flex-column justify-content-between align-items-start bg-blue">
                            <h3>1</h3>
                            <p>{{$data->first_block[app()->getLocale()]['description']}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="organize-block__card h-100 text-white d-flex flex-column justify-content-between align-items-start bg-yellow">
                            <h3>2</h3>
                            <p>{{$data->two_block[app()->getLocale()]['description']}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="organize-block__card h-100 text-white d-flex flex-column justify-content-between align-items-start bg-blue">
                            <h3>3</h3>
                            <p>{{$data->three_block[app()->getLocale()]['description']}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="organize-block__card h-100 text-white d-flex flex-column justify-content-between align-items-start bg-yellow">
                            <h3>4</h3>
                            <p>{{$data->four_block[app()->getLocale()]['description']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Organize block end -->

        <!-- About -->
        <section class="about">
            <div class="container">
                <div class="about-content d-flex align-items-start justify-content-between">
                    <div class="about-content__left">
                        <h2>{{$data->title_2[app()->getLocale()]['title_2']}}</h2>
                        <ul class="d-flex flex-column">
                            @php
                                use Illuminate\Support\Str;
                                $description = Str::between($data->description[app()->getLocale()]['description'], '<ul>', '</ul>');
                            @endphp

                            {!! $description !!}
                        </ul>
                    </div>
                    <div class="about-content__right">
                        <img src="{{asset('storage/' . $data->big_image)}}" alt="" class="big-img">
                        <img src="{{asset('storage/' . $data->small_image)}}" alt="">
                    </div>
                </div>
                <div class="about-foot d-flex align-items-center justify-content-between">
                    <p>{{__($data->partner[app()->getLocale()]['title'])}}</p>
                    <a href="#" class="btn_blue" data-bs-toggle="modal" data-bs-target="#nutritionModal" wire:click="$dispatch('openPartner')">{{__('Подробнее')}}</a>
                </div>
            </div>
        </section>
        <!-- About end -->

        <!-- Partners -->
        <div class="partners">
            <div class="partners-bg"></div>
{{--            <img src="{{asset('assets/images/partners-bg.png')}}" alt="" class="partners-bg">--}}
            <div class="container">
                <ul class="partners-card__wrap d-flex flex-wrap align-items-center">
                    @foreach($data->partner['images'] as $value)
                    <li class="partners-card d-flex align-items-center justify-content-center">
                        <img src="{{asset('storage/' . $value['logo'])}}" alt="">
                    </li>
                    @endforeach
                </ul>
                <div class="partners-content">
                    <div class="text-wrap">
                        <img src="{{asset('assets/images/text-icon-1.svg')}}" alt="" class="icon-1">
                        <p class="text-center">
                            {!! $data->partner[app()->getLocale()]['text'] !!}
                        </p>
                        <img src="{{asset('assets/images/text-icon-2.svg')}}" alt="" class="icon-2">
                    </div>
                    <h4 class="text-center"><span>— {{__('Алексей Юдин')}}</span>, {{__('основатель')}} AG-CHUKOTKA</h4>
                </div>
            </div>
        </div>
        <!-- Partners end -->

        <!-- Registration -->
        <section class="registration">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center text-center">
                    <h2>{{__('учетная карточка организации')}}</h2>
                </div>
                <ul>

                    @foreach($data->card_organization[app()->getLocale()]['card'] as $value)
                        <li class="d-flex align-items-start justify-content-between">
                            <h3>{{$value['title']}}</h3>
                            <h4>{!! $value['description'] !!}</h4>
                        </li>
                    @endforeach

                </ul>
            </div>
        </section>
        <!-- Registration end -->

        <!-- Request -->
        <livewire:components.no-time-to-search />
        <!-- Request end -->

    </main>
</div>
