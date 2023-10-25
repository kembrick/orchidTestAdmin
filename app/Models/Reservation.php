<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;


/**
 * App\Models\Reservation
 *
 * @mixin Eloquent
 */
class Reservation extends Model
{
    use AsSource, Filterable, HasFactory;

    /**
     * @var mixed
     */

    protected $table = 'reservations';
    protected $fillable = ['client', 'phone', 'when', 'comment'];
    protected $allowedSorts = ['client' , 'when'];
    protected $allowedFilters = ['client'];

}
