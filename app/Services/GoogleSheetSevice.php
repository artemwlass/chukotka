<?php

namespace App\Services;

use App\Models\ExcelKey;
use App\Models\NoTimeToSearch;
use App\Models\PersonalTour;
use App\Models\ReservationTour;
use Carbon\Carbon;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetSevice
{
    public $order;
    public $form;
    public function __construct($orderId, $form)
    {
        $this->form = $form;
        if ($this->form == 'Заявка с формы- нет времени на поиск') {
            $this->order = NoTimeToSearch::find($orderId);
        } elseif ($this->form == 'Заявка с формы- Бронирования') {
            $this->order = ReservationTour::find($orderId);
        } elseif($this->form == 'Заявка с формы- персональный тур') {
            $this->order = PersonalTour::find($orderId);
        }

    }
    public function addToSheet()
    {
        $excel = ExcelKey::first();
        if ($excel) {
            $data = [
                "Имя" => $this->order->name,
                "Телефон" => $this->order->phone,
                "Email" => $this->order->email,
                "Тур" => $this->order->tour?->title,
                "Дата брони" => $this->order->booking
                    ? $this->order->booking->date_from . ' - ' . $this->order->booking->date_to
                    : '',
                "Количество детей" => $this->order->countChild,
                "Количество взрослых" => $this->order->countAdults,
                "Комментарий" => $this->order->comment ?? '',
                "Дата и время" => Carbon::now()->format('Y-m-d H:i:s'),
                "Форма" => $this->form,
            ];


            // ID вашей Google таблицы
            $spreadsheetId = $excel->key;

            // Название листа в таблице
            $sheetName = 'Лист1';

            // Получение доступа к таблице
            $sheet = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName);

            // Добавление данных в таблицу
            $sheet->append([$data]);
        }
    }
}
