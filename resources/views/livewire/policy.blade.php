<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <span class="text-blue">{{__('Политика конфиденциальности')}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Policy -->
        <section class="policy">
            <div class="container">
                <div class="policy-content">
                    <h2>{{__($data->title[app()->getLocale()]['title'])}}</h2>

                    {!! __($data->description[app()->getLocale()]['description']) !!}

                </div>
            </div>
        </section>
        <!-- Policy end -->

    </main>
</div>
