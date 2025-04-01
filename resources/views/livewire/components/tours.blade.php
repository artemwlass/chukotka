<div>
    <section class="tours {{Route::currentRouteName() !== 'index' ? 'tours-page' : ''}}">
        <div class="container">
            @if(Route::currentRouteName() !== 'index')
                <h2>{{ __('Туры') }}</h2>
            @endif

            <div class="row">
                @foreach ($tours as $index => $tour)
                    @php
                        $earliestDate = $tour->bookings->min('date_from');
                        $minPrice = $tour->bookings->min('price');
                        $dateCount = count($tour->bookings)
                    @endphp
                    @if ($index % 8 === 0)
                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="tours-card d-flex flex-column justify-content-between
    {{ $tour->type_logo == 'blue' ? 'bg-blue' : ($tour->type_logo == 'orange' ? 'bg-yellow' : '') }}">

                                @if($tour->type_logo == 'image')
                                    <img src="{{ asset('storage/' . $tour->main_image) }}" alt="" class="main-img">
                                @endif
                                <div
                                    class="tours-card__head d-flex flex-column flex-lg-row align-items-start justify-content-between">
                                    <ul class="d-flex align-items-stretch rounded-pill text-white"
                                        data-bs-target="#dateModal-{{ $tour->id }}"
                                        data-bs-toggle="modal"
{{--                                        wire:click="$dispatch('openDateModal', { id: {{ $tour->id }} })"--}}
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
                                    <a href="{{route('tour', ['slug' => $tour->slug])}}"
                                       class="d-flex align-items-center justify-content-center rounded-circle">
                                        <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.9831 1.56529C19.0192 1.15266 18.714 0.788881 18.3014 0.75278L11.5771 0.164479C11.1644 0.128377 10.8006 0.433621 10.7645 0.846258C10.7284 1.25889 11.0337 1.62267 11.4463 1.65877L17.4235 2.1817L16.9006 8.15887C16.8645 8.57151 17.1697 8.93528 17.5823 8.97139C17.995 9.00749 18.3587 8.70224 18.3948 8.28961L18.9831 1.56529ZM1.48209 16.5372L18.7181 2.07446L17.7539 0.925393L0.517909 15.3881L1.48209 16.5372Z" fill="white"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @elseif ($index % 8 === 1)
                        {{-- Второй блок (шире) --}}
                        <div class="col-12 col-sm-6 col-xl-8">
                            <div class="tours-card d-flex flex-column justify-content-between
    {{ $tour->type_logo == 'blue' ? 'bg-blue' : ($tour->type_logo == 'orange' ? 'bg-yellow' : '') }}">

                                @if($tour->type_logo == 'image')
                                    <img src="{{ asset('storage/' . $tour->main_image) }}" alt="" class="main-img">
                                @endif
                                <div
                                    class="tours-card__head d-flex flex-column flex-lg-row align-items-start justify-content-between">
                                    <ul class="d-flex align-items-stretch rounded-pill text-white"
                                        data-bs-target="#dateModal-{{ $tour->id }}"
                                        data-bs-toggle="modal"
{{--                                        wire:click="$dispatch('openDateModal', { id: {{ $tour->id }} })"--}}
                                    >
                                        <li>{{ \Carbon\Carbon::parse($earliestDate)->format('d.m') }}</li>
                                        @if($dateCount > 1)
                                            <li>+{{ $dateCount }} даты</li>
                                        @endif

                                    </ul>
                                    <h4 class="rounded-pill">От {{$minPrice}}₽</h4>
                                </div>
                                <div class="d-flex align-items-end justify-content-between">
                                    <h3 class="text-uppercase text-white">{{__($tour->title)}}</h3>
                                    <a href="{{route('tour', ['slug' => $tour->slug])}}"
                                       class="d-flex align-items-center justify-content-center rounded-circle">
                                        <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.9831 1.56529C19.0192 1.15266 18.714 0.788881 18.3014 0.75278L11.5771 0.164479C11.1644 0.128377 10.8006 0.433621 10.7645 0.846258C10.7284 1.25889 11.0337 1.62267 11.4463 1.65877L17.4235 2.1817L16.9006 8.15887C16.8645 8.57151 17.1697 8.93528 17.5823 8.97139C17.995 9.00749 18.3587 8.70224 18.3948 8.28961L18.9831 1.56529ZM1.48209 16.5372L18.7181 2.07446L17.7539 0.925393L0.517909 15.3881L1.48209 16.5372Z" fill="white"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Следующие 6 блоков --}}
                        <div class="col-12 col-sm-6 col-xl-4">
                            <div class="tours-card d-flex flex-column justify-content-between
    {{ $tour->type_logo == 'blue' ? 'bg-blue' : ($tour->type_logo == 'orange' ? 'bg-yellow' : '') }}">

                                @if($tour->type_logo == 'image')
                                    <img src="{{ asset('storage/' . $tour->main_image) }}" alt="" class="main-img">
                                @endif
                                <div
                                    class="tours-card__head d-flex flex-column flex-lg-row align-items-start justify-content-between">
                                    <ul class="d-flex align-items-stretch rounded-pill text-white"
                                        data-bs-target="#dateModal-{{ $tour->id }}"
                                        data-bs-toggle="modal"
{{--                                        wire:click="$dispatch('openDateModal', { id: {{ $tour->id }} })"--}}
                                    >
                                        <li>{{ \Carbon\Carbon::parse($earliestDate)->format('d.m') }}</li>
                                        @if($dateCount > 1)
                                            <li>+{{ $dateCount }} даты</li>
                                        @endif
                                    </ul>
                                    <h4 class="rounded-pill">От {{$minPrice}}₽</h4>
                                </div>
                                <div class="d-flex align-items-end justify-content-between">
                                    <h3 class="text-uppercase text-white">{{__($tour->title)}}</h3>
                                    <a href="{{route('tour', ['slug' => $tour->slug])}}"
                                       class="d-flex align-items-center justify-content-center rounded-circle">
                                        <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.9831 1.56529C19.0192 1.15266 18.714 0.788881 18.3014 0.75278L11.5771 0.164479C11.1644 0.128377 10.8006 0.433621 10.7645 0.846258C10.7284 1.25889 11.0337 1.62267 11.4463 1.65877L17.4235 2.1817L16.9006 8.15887C16.8645 8.57151 17.1697 8.93528 17.5823 8.97139C17.995 9.00749 18.3587 8.70224 18.3948 8.28961L18.9831 1.56529ZM1.48209 16.5372L18.7181 2.07446L17.7539 0.925393L0.517909 15.3881L1.48209 16.5372Z" fill="white"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <livewire:components.date-modal :id="$tour->id" />

                @endforeach
            </div>
        </div>
    </section>
</div>
