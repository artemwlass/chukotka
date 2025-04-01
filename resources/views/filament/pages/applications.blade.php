<x-filament-panels::page>
    <form wire:submit="submit" class="space-y-6 max-w-2xl">
        {{ $this->form }}

        <x-filament::button type="submit">
            Сохранить ключ
        </x-filament::button>

        {{-- Плейсхолдер / Подсказка --}}
        <div class="mt-6 text-gray-500">
            🤖 Пригласите бота в таблицу: <strong>ag-chukotka@ag-chukotka.iam.gserviceaccount.com</strong>
        </div>
    </form>
</x-filament-panels::page>
