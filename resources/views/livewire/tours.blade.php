<div>
    <main>

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <div class="container breadcrumb-container d-flex align-items-center flex-wrap">
                <a href="/">{{__('Главная')}}</a>
                <span>/</span>
                <span class="text-blue">{{__('Туры')}}</span>
            </div>
        </section>
        <!-- Breadcrumb end -->

        <!-- Tours -->
        <livewire:components.tours />

        <!-- Tours end -->

        <!-- Request -->
        <livewire:components.no-time-to-search />
        <!-- Request end -->

    </main>
</div>
