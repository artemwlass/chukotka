<?php

namespace App\Livewire\Components;

use App\Models\ReservationTour;
use App\Models\Tour;
use App\Models\User;
use App\Notifications\OrderToTelegramNotification;
use App\Notifications\ReservationToTelegramNotification;
use App\Services\GoogleSheetSevice;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class BookTour extends Component
{
    public $tour;
    public $bookId;

    public $name;
    public $countAdults;
    public $countChild;
    public $email;
    public $phone;
    public $comment;
    public $agree;

    #[On('openBookTour')]
    public function getBookTour($tourId, $bookId)
    {
        $this->tour = Tour::where('is_active', true)->with('bookings')->find($tourId);
        $this->bookId = $bookId;
    }

    public function storeBooking()
    {
        $this->validate([
            'bookId' => 'required|exists:bookings,id',
            'phone' => 'required|string',
            'agree' => 'accepted',

            'name' => 'nullable|string|max:255',
            'countAdults' => 'nullable|integer|min:0',
            'countChild' => 'nullable|integer|min:0',
            'email' => 'nullable|email|max:255',
            'comment' => 'nullable|string',
        ], [
            'bookId.required' => __('Выберите дату заезда.'),
            'bookId.exists' => __('Выбранная дата не найдена.'),
            'phone.required' => __('Поле "Контактный телефон" обязательно для заполнения.'),
            'phone.min' => __('Введите корректный номер телефона.'),
            'agree.accepted' => __('Вы должны согласиться с условиями политики конфиденциальности.'),
        ]);

        // Создаем запись в таблице заявок
        $order = ReservationTour::create([
            'tour_id' => $this->tour->id,
            'booking_id' => $this->bookId,
            'name' => $this->name ?? '',
            'count_adults' => $this->countAdults ?? 0,
            'count_child' => $this->countChild ?? 0,
            'email' => $this->email ?? '',
            'phone' => $this->phone,
            'comment' => $this->comment ?? '',
            'agree' => $this->agree,
        ]);

        $this->reset(['name', 'countAdults', 'countChild', 'email', 'phone', 'comment', 'agree']);

        $user = User::first();
        $user->notify(new ReservationToTelegramNotification($order));

        $this->dispatch('open-thank-modal');

        $sheet = new GoogleSheetSevice($order->id,'Заявка с формы- Бронирования');
        $sheet->addToSheet();
    }

    public function render()
    {
        return view('livewire.components.book-tour');
    }
}
