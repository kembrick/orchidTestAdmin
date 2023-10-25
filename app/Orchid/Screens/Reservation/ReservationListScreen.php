<?php

namespace App\Orchid\Screens\Reservation;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Orchid\Layouts\Reservation\ReservationListTable;
use App\Orchid\Layouts\CreateOrUpdateReservation;
use Orchid\Screen\Action;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;


class ReservationListScreen extends Screen
{

    public $name = 'Запись на прием';
    public $description = 'Список занятого времени';
    //public $permission = 'platform.reservations';


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'reservations' => Reservation::filters()->defaultSort('when', 'desc')->paginate(10),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
/*
    public function name(): ?string
    {
        return $this->name;
    }
*/

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить запись')->modal('createReservation')->method('createOrUpdateReservation')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ReservationListTable::class,
            Layout::modal('createReservation', CreateOrUpdateReservation::class)->title('Создание записи')->applyButton('Создать'),
            Layout::modal('editReservation', CreateOrUpdateReservation::class)->async('asyncGetReservation'),
        ];
    }

    public function create(ReservationRequest $request): void
    {
        Reservation::create($request->except('_token'));
        Toast::info('Запись создана');
    }

    public function asyncGetReservation(Reservation $reservation): array
    {
        return [
            'reservation' => $reservation
        ];
    }

    public function createOrUpdateReservation(ReservationRequest $request): void
    {
        //dd($request->all());
        $reservationId = $request->input('reservation.id');
        Reservation::updateOrCreate([
            'id' => $reservationId
        ], $request->validated()['reservation']);
        is_null($reservationId) ? Toast::info('Запись создана') : Toast::info('Запись обновлена');
    }

}
