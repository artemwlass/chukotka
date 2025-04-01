<div>
    <div class="langs">
        <div class="langs-btn d-flex align-items-center">
            <input type="text" value="{{ strtoupper($currentLang) }}" readonly hidden>
            <span>{{ strtoupper($currentLang) }}</span>
            <img src="{{ asset('assets/images/chevron-down-blue.svg') }}" alt="">
        </div>
        <ul class="langs-list">
            @foreach (['ru' => 'RU', 'en' => 'EN'] as $langKey => $langLabel)
                @if ($langKey !== $currentLang)
                    <a href="{{ url($langKey) }}">
                        <li>{{ $langLabel }}</li>
                    </a>
                @endif
            @endforeach
        </ul>
    </div>
</div>
