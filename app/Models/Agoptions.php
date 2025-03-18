<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class agoptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'option_id',
        'nop',
        'price'
    ];

    public static function avilabelOp(string $date, int $agencyId){
        return   DB::table('options')
        ->select('options.id', 'options.optionName' ,'agoptions.price', DB::raw('agoptions.nop - COALESCE(rented_options.rented_count, 0) AS av'), 'rented_options.rented_count')
        ->leftJoin(DB::raw('(SELECT rent_options.agop_id, COUNT(rent_options.id) AS rented_count
                    FROM rent_options
                    INNER JOIN rents ON rent_options.rent_id = rents.id
                    WHERE rents.endDate > ? OR rents.endDate IS NULL
                    GROUP BY rent_options.agop_id) AS rented_options'), 'rented_options.agop_id', '=', 'options.id')
        ->leftJoin('agoptions', 'agoptions.option_id', '=', 'options.id')
        ->whereRaw('agoptions.agency_id = ?', [$agencyId])
        ->groupBy('options.id', 'options.optionName', 'agoptions.nop',  'agoptions.price', 'rented_options.rented_count')
        ->setBindings([$date], 'select')
        ->get();
    }

}
