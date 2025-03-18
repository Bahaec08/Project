<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Option extends Model
{
    use HasFactory;




    public function scopeAgencyOp($query, int $agid, string $zero = '=')
    {
        return $query->select(DB::raw('options.id as id, options.optionName as opname, count(agoptions.id) as nop, agoptions.price as price'))
            ->leftJoin('agoptions', function($join) use ($agid) {
                $join->on('options.id', '=', 'agoptions.option_id')
                    ->where('agoptions.agency_id', '=', $agid);
            })
            ->groupBy('id')
            ->groupBy('opname')
            ->groupBy('price')
            ->having('nop', $zero, '0')
            ->get()->toArray();
    }

    public function scopeNoOption($query, int $agid){
        return $query->select(DB::raw('count(options.id) as nop'))
        ->join('agoptions', function($join) use ($agid) {
            $join->on('options.id', '=', 'agoptions.option_id')
                ->where('agoptions.agency_id', '=', $agid);
        })
        ->distinct()
        ->first()->nop;
    }
}
