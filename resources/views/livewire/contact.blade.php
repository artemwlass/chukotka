<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <span class="text-blue">{{__('Контакты')}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->
        <!-- Contact -->
        <section class="contact">
            <div class="container contact-container">
                <h2>{{$data->content[app()->getLocale()]['title']}}</h2>
                {!! $data->content['map'] !!}
                <div class="contact-content d-flex flex-wrap">
{{--                    <img src="{{asset('assets/images/contact-content-bg.png')}}" alt="" class="contact-content__bg">--}}
                    <div class="contact-content__item d-flex flex-column">
                        <label for="">{{__('Номер телефона')}}</label>
                        <a href="tel:{{$data->content['phone']}}">{{$data->content['phone']}}</a>
                    </div>
                    <div class="contact-content__item d-flex flex-column">
                        <label for="">E-mail</label>
                        <a href="mailto:{{$data->content['email']}}">{{$data->content['email']}}</a>
                    </div>
                    <div class="contact-content__item d-flex flex-column">
                        <label for="">{{__('Адрес')}}</label>
                        <p>{{$data->content['address']}}</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact end -->
    </main>
</div>
