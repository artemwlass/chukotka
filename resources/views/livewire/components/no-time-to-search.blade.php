<div>
    <section class="request">
        <div class="container request-container">
{{--            <img src="{{asset('assets/images/request-bg.png')}}" alt="" class="bg-img">--}}
            <h2>{{__('Нет времени на поиск?')}}</h2>
            <h3>{{__('Мы поможем подобрать тур по вашим предпочтениям')}}</h3>


            <form wire:submit.prevent="create">
                <div class="inp-wrap d-flex flex-wrap">
                    @error('name') {{ $message }} @enderror
                    <input type="text" wire:model="name" placeholder="ФИО" class="form-inp">
                    @error('phone') {{ $message }} @enderror
                    <input type="tel" wire:model="phone" placeholder="Ваш номер телефона" class="form-inp">
                    @error('agree') {{ $message }} @enderror
                </div>
                <div class="form-checkbox d-flex align-items-start">
                    <input type="checkbox" wire:model="agree" name="" id="check1">
                    <label for="check1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-check" viewBox="0 0 16 16">
                            <path
                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                    </label>
                    <p>{{__('Я даю согласие на обработку моих персональных данных и соглашаюсь с политикой конфиденциальности')}}</p>
                </div>
                <button type="submit" class="btn_white" data-bs-toggle="modal">{{__('Оставить нам заявку')}}</button>
            </form>
            <img src="{{asset('assets/images/request-card.png')}}" alt="" class="request-card">
            <img src="{{asset('assets/images/request-card-lg.png')}}" alt="" class="request-card lg">
        </div>
    </section>
    @script
    <script>
        $wire.on('open-thank-modal', () => {
            console.log(434)
            var thankModal = new bootstrap.Modal(document.getElementById('thankModal'));
            thankModal.show();
        });

    </script>
    @endscript
</div>
