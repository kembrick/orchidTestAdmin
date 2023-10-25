<?php

namespace App\Orchid\Layouts\Reservation;

use App\Models\Reservation;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\ModalToggle;

class ReservationListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'reservations';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('client', 'Клиент')->cantHide()->filter()->sort()
                ->render(function (Reservation $reservation) {
                    return ModalToggle::make($reservation->client)
                        ->modal('editReservation')
                        ->method('createOrUpdateReservation')
                        ->modalTitle('Редактирование ' . $reservation->client)
                        ->asyncParameters([
                            'reservation' => $reservation->id
                        ]);
                }),
            TD::make('client', 'Клиент'),
            TD::make('phone', 'Телефон'),
            TD::make('when', 'Время')->sort()->render(function ($reg) {
                return e(date('d.m.Y (H:i)', strtotime($reg->when)));
            }),
            TD::make('comment', 'Сообщение')->width('700px'),
            TD::make('action', 'Действие')->cantHide()
                ->render(function (Reservation $reservation) {
                    return ModalToggle::make('редактировать')
                        ->modal('editReservation')
                        ->method('createOrUpdateReservation')
                        ->modalTitle('Редактирование ' . $reservation->client)
                        ->icon('note')
                        ->class('actionButton')
                        ->asyncParameters([
                            'reservation' => $reservation->id
                        ]);
                })
        ];
    }
}
