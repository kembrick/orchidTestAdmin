<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //'phone' => ['phone:RU', 'required'],
            'reservation.client' => ['required'],
            'reservation.phone' => ['required'],
            'reservation.when' => ['required', 'date_format:Y-m-d H:i'],
            'reservation.comment' => ['required'],
        ];
    }
}
