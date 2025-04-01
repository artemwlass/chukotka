<div>
    <main>
        <livewire:components.video-modal :video="$data->about_company['title_video_link']" />

        <!-- Home -->
        <section class="home position-relative">
            <div class="home-bg position-absolute w-100 h-100">
                <img src="{{asset('storage/' . $data->image_bg)}}" alt="">
            </div>
            <div class="container home-container d-flex flex-column justify-content-end">
                <h1>
                    {!! __($data->title[app()->getLocale()]['title']) !!}
                    <span>
                            <img src="{{asset('storage/' . $data->title['image'])}}" alt="">
                            {!! __($data->title[app()->getLocale()]['title2']) !!}
                        </span>
                </h1>
                <ul class="d-flex justify-content-center align-items-start text-white text-center">
                    @foreach($data->option[app()->getLocale()]['options'] as $value)
                        <li class="d-flex flex-column align-items-center">
                            <img src="{{asset('storage/' . $value['icon'])}}" alt="">
                            <h3 class="mt-3">{!! __($value['title']) !!}</h3>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!-- Home end -->

        <!-- Tours -->
        <livewire:components.tours />
        <!-- Tours end -->

        <!-- Organize -->
        <section class="organize">
            <div class="container position-relative organize-container">
{{--                <img src="{{asset('assets/images/organize-bg.png')}}" alt="" class="organize-bg">--}}
                <h2 class="text-uppercase">
                    {{__($data->personal_tour[app()->getLocale()]['title'])}}
                    <span>
                            <img src="{{asset('storage/' . $data->personal_tour['icon'])}}" alt="">
                            {{__($data->personal_tour[app()->getLocale()]['title2'])}}
                        </span>
                </h2>
                <p>{{__($data->personal_tour[app()->getLocale()]['description'])}}</p>
                <div class="organize-btns d-flex align-items-center">
                    <a href="#" class="btn_white">{{__('Подробнее')}}</a>
                    <a href="#" class="btn_light" data-bs-toggle="modal" data-bs-target="#tourModal">{{__('Заявка на корпоративный тур')}}</a>
                </div>
                <img src="{{asset('storage/' . $data->personal_tour['image'])}}" alt="" class="organize-card">
                <img src="{{asset('storage/' . $data->personal_tour['image_mob'])}}" alt="" class="organize-card lg">
            </div>
        </section>
        <!-- Organize end -->

        <!-- Kompany -->
        <section class="company">
            <div class="company-bg"></div>

            {{--            <img src="{{asset('assets/images/company-bg.png')}}" alt="" class="company-bg">--}}
            <div class="container">
                <div class="company-head">
                    <h2 class="text-uppercase">{{__($data->about_company[app()->getLocale()]['title'])}}</h2>
                    <ul class="d-flex flex-column">
                        @php
                            use Illuminate\Support\Str;
                            $description = Str::between($data->about_company[app()->getLocale()]['description'], '<ul>', '</ul>');
                        @endphp
                        {!! $description !!}
                    </ul>
                    <div class="company-head__card">
                        <img src="{{asset('storage/' . $data->about_company['image_big'])}}" alt="" class="big-img">
                        <img src="{{asset('storage/' . $data->about_company['image_small'])}}" alt="" class="small-img">
                    </div>
                    <div class="company-head__btns d-flex align-items-center">
                        <a href="{{route('about')}}" class="btn_white">{{__('Подробнее')}}</a>
                        <a href="#" class="btn_light" data-bs-toggle="modal" data-bs-target="#tourModal">{{__('Заявка на корпоративный тур')}}</a>
                    </div>
                </div>
                <ul class="company-body d-flex align-items-center justify-content-between flex-wrap">
                    @foreach($data->about_company['partner'] as $value)
                        <li class="rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{asset('storage/' . $value['icon'])}}" alt="">
                        </li>
                    @endforeach

                </ul>
                <div class="company-foot d-flex flex-column justify-content-between align-items-start">
                    <img src="{{asset('assets/images/company-foot.png')}}" alt="" class="main-img">
                    <img src="{{asset('assets/images/company-foot-lg.png')}}" alt="" class="main-img lg">
                    <button class="play-btn d-flex align-items-center justify-content-center rounded-circle" data-bs-toggle="modal" data-bs-target="#videoModal">
                        <img src="{{asset('assets/images/play-icon.svg')}}" alt="">
                    </button>
                    <h3>{!! __($data->about_company[app()->getLocale()]['title_video'] ) !!}</h3>
                    <ul class="d-flex w-100 justify-content-between align-items-end">
                        @php
                            $description = Str::between($data->about_company[app()->getLocale()]['title_video_description'], '<ul>', '</ul>');
                        @endphp
                        {!! $description !!}
                    </ul>
                </div>
            </div>
        </section>
        <!-- Kompany end -->

        <!-- Blog -->
        <section class="blog">
            <div class="container">
                <h2>{{__('Блог')}}</h2>
                <div class="row">
                    @foreach ($posts as $index => $post)
                        @if ($index === 0)
                            <div class="col-12 col-xl-8">
                                <a href="{{route('post', ['slug' => $post->slug])}}" class="d-flex flex-column justify-content-between blog-card__head h-100">
                                    <div class="main-img">
                                        <img src="{{asset('storage/' . $post->image)}}" alt="">
                                    </div>
                                    <ul class="alerts d-flex flex-wrap align-items-center">
                                        @foreach($post->tags as $value)
                                            <li class="{{__($value['color'])}}">{{__($value['title'])}}</li>
                                        @endforeach
                                    </ul>
                                    <div>
                                        <ul class="datas d-flex align-items-center flex-wrap">
                                            <li class="d-flex align-items-center gap-2">
                                                <img src="{{asset('assets/images/calendar-icon.svg')}}" alt="">
                                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-2">
                                                <img src="{{asset('assets/images/eye-icon.svg')}}" alt="">
                                                <span>{{$post->views}}</span>
                                            </li>
                                            <li class="d-flex align-items-center gap-2">
                                                <img src="{{asset('assets/images/user-icon.svg')}}" alt="">
                                                <span>{{__($post->author)}}</span>
                                            </li>
                                        </ul>
                                        <h3>{{__($post->title)}}</h3>
                                    </div>
                                </a>

                            </div>
                        @else
                            <div class="col-12 col-sm-6 col-xl-4">
                                <a href="{{route('post', ['slug' => $post->slug])}}">
                                    <div class="blog-card sm-card">
                                        <div class="blog-card__head d-flex flex-column justify-content-between">
                                            <div class="main-img">
                                                <img src="{{asset('storage/' . $post->image)}}" alt="">
                                            </div>
                                            <ul class="alerts d-flex flex-wrap align-items-center">
                                                @foreach($post->tags as $value)
                                                    <li class="{{__($value['color'])}}">{{__($value['title'])}}</li>
                                                @endforeach
                                            </ul>
                                            <ul class="datas d-flex align-items-center">
                                                <li class="d-flex align-items-center gap-2">
                                                    <img src="{{asset('assets/images/calendar-icon.svg')}}" alt="">
                                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}</span>
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    <img src="{{asset('assets/images/eye-icon.svg')}}" alt="">
                                                    <span>{{$post->views}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="blog-card__body">
                                            <div class="name d-flex align-items-center gap-2">
                                                <img src="{{asset('assets/images/user-icon-blue.svg')}}" alt="">
                                                <span>{{__($post->author)}}</span>
                                            </div>
                                            <h3>{{__($post->title)}}</h3>
                                            <p>{{ Str::limit(strip_tags(__($post->description)), 100, '...') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{route('blog')}}" class="btn_blue">{{__('Смотреть больше статей')}}</a>
                </div>
            </div>
        </section>
        <!-- Blog end -->

        <!-- Request -->
        <livewire:components.no-time-to-search />
        <!-- Request end -->

    </main>
</div>
