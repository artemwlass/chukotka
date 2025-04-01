<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <span class="text-blue">{{__('Блог')}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Blog -->
        <section class="blog">
            <div class="container">
                <h2>{{__($data->title['title'])}}</h2>
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
                                <a style="width: 100%" href="{{route('post', ['slug' => $post->slug])}}">
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
                {{ $posts->links('components.custom-pagination') }}
            </div>
        </section>
        <!-- Blog end -->

        <!-- Request -->
        <livewire:components.no-time-to-search/>
        <!-- Request end -->

    </main>
</div>
