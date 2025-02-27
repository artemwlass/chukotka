@extends('components.layouts.app') {{-- Укажите нужный layout, если используете его --}}


@section('slot')
    <main>

        <!-- Error page -->
        <section class="error-page">
            <div class="container error-page__container d-flex flex-column align-items-center justify-content-center h-100 text-center">
                <img src="{{asset('assets/images/error-page-card.png')}}" alt="" class="error-page__number">
                <h2>Страница <br> не найдена</h2>
                <p>Вы можете вернуться на главную страницу сайта, нажмите на кнопку ниже.</p>
                <a href="/" class="btn_blue">Вернуться на главную</a>
            </div>
        </section>
        <!-- Error page end -->

    </main>
@endsection
