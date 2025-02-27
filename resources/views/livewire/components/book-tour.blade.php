<div>
    <div class="modal book-tour fade" id="bookTour" tabindex="-1" aria-labelledby="bookTourLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content align-items-start">
                <button class="btn_close d-flex align-items-center justify-content-center rounded-circle" type="button"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M8.00031 9.41403L13.6573 15.071C13.8459 15.2532 14.0985 15.354 14.3607 15.3517C14.6229 15.3494 14.8737 15.2443 15.0591 15.0588C15.2445 14.8734 15.3497 14.6226 15.352 14.3604C15.3543 14.0982 15.2535 13.8456 15.0713 13.657L9.41431 8.00003L15.0713 2.34303C15.2535 2.15443 15.3543 1.90182 15.352 1.63963C15.3497 1.37743 15.2445 1.12662 15.0591 0.941209C14.8737 0.755801 14.6229 0.650632 14.3607 0.648353C14.0985 0.646075 13.8459 0.746869 13.6573 0.929027L8.00031 6.58603L2.34331 0.929027C2.15386 0.751372 1.90272 0.654393 1.64304 0.65861C1.38336 0.662826 1.1355 0.767909 0.951921 0.951621C0.768338 1.13533 0.663431 1.38326 0.659398 1.64295C0.655365 1.90263 0.752522 2.1537 0.930311 2.34303L6.58631 8.00003L0.929311 13.657C0.833801 13.7493 0.757619 13.8596 0.70521 13.9816C0.652801 14.1036 0.625215 14.2348 0.624061 14.3676C0.622907 14.5004 0.648209 14.6321 0.69849 14.755C0.748771 14.8779 0.823024 14.9895 0.916916 15.0834C1.01081 15.1773 1.12246 15.2516 1.24536 15.3018C1.36825 15.3521 1.49993 15.3774 1.63271 15.3763C1.76549 15.3751 1.89671 15.3475 2.01872 15.2951C2.14072 15.2427 2.25106 15.1665 2.34331 15.071L8.00031 9.41403Z"
                              fill="#0252DD"/>
                    </svg>
                </button>
                @php
                    $minPrice = $tour?->bookings->min('price');
                @endphp
                <h3>{{__('Стоимость тура от')}} {{$minPrice}}₽</h3>
                <h2>{{__('Бронирование тура')}} <br>{{__($tour?->title)}}</h2>
                <div class="form_control__wrap d-flex flex-column">
                    <div class="form_control">
                        <label for="">{{__('Дата заезда')}}</label>
                        <select name="" id="" class="form_control__inp" wire:model="bookId">
                            @if ($tour)
                                @foreach ($tour->bookings as $booking)
                                    <option value="{{ $booking->id }}" {{$booking->id === $bookId ? 'selected' : ''}}>
                                        {{ \Carbon\Carbon::parse($booking->date_from)->translatedFormat('d F Y') }} {{__('по')}}
                                        {{ \Carbon\Carbon::parse($booking->date_to)->translatedFormat('d F Y') }} —
                                        {{ $booking->price }}₽
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form_control">
                        <label for="">{{__('Представьтесь, пожалуйста')}}</label>
                        <input type="text" placeholder="Введите имя" class="form_control__inp" wire:model="name">
                    </div>
                    <div class="form_control">
                        <label for="">{{__('Количество взрослых')}}</label>
                        <input type="number" placeholder="Введите количество" class="form_control__inp" wire:model="countAdults">
                    </div>
                    <div class="form_control">
                        <label for="">{{__('Количество детей')}}</label>
                        <input type="number" placeholder="Введите количество" class="form_control__inp" wire:model="countChild">
                    </div>
                    <div class="form_control">
                        <label for="">{{__('Адрес электронной почты')}}</label>
                        <input type="email" placeholder="E-mail" class="form_control__inp" wire:model="email">
                    </div>
                    @error('phone') <p class="error-text">{{ $message }}</p> @enderror
                    <div class="form_control">
                        <label for="">{{__('Контактный телефон*')}}</label>
                        <input type="tel" placeholder="Введите номер телефона" class="form_control__inp" wire:model="phone">
                    </div>
                    <div class="form_control">
                        <label for="">{{__('Дополнительные пожелания (учтем при подготовке предложения)')}}</label>
                        <textarea name="" id="" class="form_control__inp" placeholder="Введите текст" wire:model="comment"></textarea>
                    </div>
                </div>
                @error('agree') <p class="error-text">{{ $message }}</p> @enderror
                <div class="form_checkbox d-flex align-items-start">
                    <input type="checkbox" name="" id="check-2" wire:model="agree">
                    <label for="check-2" class="icon">
                        <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.29845 5.40514L0.861587 3.14959L0 3.94702L3.29845 7L10 0.79744L9.13841 7.52847e-06L3.29845 5.40514Z"
                                fill="white"/>
                        </svg>
                    </label>
                    <p>{{__('Я согласен с условиями')}} <a href="{{route('private-policy')}}">{{__('политики конфиденциальности')}}</a></p>
                </div>
                <button class="btn_blue" wire:click="storeBooking">{{__('Забронировать тур')}}</button>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('open-thank-modal', () => {
            console.log(434)
            var thankModal = new bootstrap.Modal(document.getElementById('thankModal'));
            var bookTourModal = bootstrap.Modal.getInstance(document.getElementById('bookTour'));
            bookTourModal.hide();
            thankModal.show();

        });

    </script>
    @endscript
</div>
