{{--<div>--}}
    <div class="modal date-modal fade" id="dateModal-{{$tour?->id}}" aria-hidden="true" aria-labelledby="dateModalLabel" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="modal-close d-flex align-items-center justify-content-center"
                        data-bs-dismiss="modal" aria-label="Close"
                >
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8.00031 9.41415L13.6573 15.0711C13.8459 15.2533 14.0985 15.3541 14.3607 15.3518C14.6229 15.3495 14.8737 15.2444 15.0591 15.059C15.2445 14.8736 15.3497 14.6227 15.352 14.3606C15.3543 14.0984 15.2535 13.8458 15.0713 13.6571L9.41431 8.00015L15.0713 2.34315C15.2535 2.15455 15.3543 1.90194 15.352 1.63975C15.3497 1.37755 15.2445 1.12674 15.0591 0.941331C14.8737 0.755923 14.6229 0.650754 14.3607 0.648475C14.0985 0.646197 13.8459 0.746991 13.6573 0.929149L8.00031 6.58615L2.34331 0.929149C2.15386 0.751494 1.90272 0.654515 1.64304 0.658732C1.38336 0.662948 1.1355 0.768031 0.951921 0.951743C0.768338 1.13546 0.663431 1.38339 0.659398 1.64307C0.655365 1.90276 0.752522 2.15382 0.930311 2.34315L6.58631 8.00015L0.929311 13.6571C0.833801 13.7494 0.757619 13.8597 0.70521 13.9817C0.652801 14.1037 0.625215 14.235 0.624061 14.3677C0.622907 14.5005 0.648209 14.6322 0.69849 14.7551C0.748771 14.878 0.823024 14.9897 0.916916 15.0835C1.01081 15.1774 1.12246 15.2517 1.24536 15.302C1.36825 15.3523 1.49993 15.3776 1.63271 15.3764C1.76549 15.3752 1.89671 15.3477 2.01872 15.2953C2.14072 15.2428 2.25106 15.1667 2.34331 15.0711L8.00031 9.41415Z"
                              fill="white"/>
                    </svg>
                </button>
                <div class="date-modal__head d-flex flex-column align-items-start justify-content-between text-white">
                    <img src="{{asset('storage/' . $tour?->main_image)}}" alt="" class="main-img">
                    @php
                        $minPrice = $tour?->bookings->min('price');
                    @endphp
                    <h4>{{__('От')}} {{$minPrice}}₽ {{'с человека'}}</h4>
                    <p>{{__($tour?->title)}}</p>
                </div>
                <div class="date-modal__body">
                    <div class="month-wrap d-flex flex-column">
                        @if ($tour)
                            @if (!empty($groupedBookings))
                                @foreach ($groupedBookings as $month => $bookings)
                                    <div class="month">
                                        <h3>{{ $month }}</h3>
                                        <ul>
                                            @foreach ($bookings as $booking)
                                                <li class="d-flex align-items-center justify-content-between">
                                                    <div class="month-value">
                                                        {{ \Carbon\Carbon::parse($booking->date_from)->format('d.m.Y') }} —
                                                        {{ \Carbon\Carbon::parse($booking->date_to)->format('d.m.Y') }}
                                                    </div>
                                                    <div class="month-day d-flex align-items-center">
                                                        <p class="d-flex align-items-center">
                                                            <img src="{{asset('assets/images/soon.svg')}}" alt="">
                                                            <span>{{ \Carbon\Carbon::parse($booking->date_from)->diffInDays($booking->date_to) }} дней</span>
                                                        </p>
                                                        <p class="d-flex align-items-center">
                                                            <img src="{{asset('assets/images/moon.svg')}}" alt="">
                                                            <span>{{ \Carbon\Carbon::parse($booking->date_from)->diffInDays($booking->date_to) - 1 }} ночей</span>
                                                        </p>
                                                    </div>
                                                    <a href="#" class="btn_orange"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#bookTour"
                                                       wire:click="$dispatch('openBookTour', { tourId: {{ $tour->id }}, bookId: {{$booking->id}} })"
                                                    >{{__('Забронировать')}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @else
                                <p>{{__('Нет доступных бронирований.')}}</p>
                            @endif
                        @else
                            <p>{{__('Тур не найден.')}}</p>
                        @endif
                    </div>
                    <a href="#" class="btn_blue">{{__('Скопировать в буфер обмена')}}</a>
                </div>
            </div>
        </div>
    </div>
{{--</div>--}}
