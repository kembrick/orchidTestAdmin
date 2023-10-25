<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class CreateOrUpdateReservation extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('reservation.id')->type('hidden'),
            Input::make('reservation.client')->title('Клиент')->required(),
            Input::make('reservation.phone')->title('Телефон')->mask('+99999999999')->required(),
            DateTimer::make('reservation.when')->format('Y-m-d H:i')->enableTime()->allowInput()->title('Дата')->required(),
            TextArea::make('reservation.comment')->title('Комментарий')->required()
        ];
    }
}
