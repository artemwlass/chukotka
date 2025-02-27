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
                <div class="policy-content__wrap">
                    <h2>{{__($data->title[app()->getLocale()]['title'])}}</h2>
                    <ol class="policy-content d-flex flex-column">
                        {!! __($data->description[app()->getLocale()]['description']) !!}
                    </ol>
                </div>
            </div>
        </section>
        <!-- Policy end -->

    </main>
</div>
