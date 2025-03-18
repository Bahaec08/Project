<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'startDate',
        'endDate',
        'requestDate',
        'user_id',
        'car_id',
        'status',
        'method'
    ];

    public function user():BelongsTo
    {
        return $this->belongsto(User::class);
    }

    public function car():BelongsTo
    {
        return $this->belongsto(Car::class);
    }

    public static function RentStatsWeek(int $week = 0, ?int $agid){
            $query = DB::table('agencies')
            ->select(DB::raw('WEEKDAY(rents.startDate) AS weekday, COUNT(rents.id) AS rentCount'))
            ->join('cars', 'cars.agency_id', '=', 'agencies.id')
            ->join('rents', 'rents.car_id', '=', 'cars.id')
            ->where('rents.status', '!=', 'waiting')
            ->whereRaw('DATE(rents.startDate) BETWEEN 
                        (CURRENT_DATE() - INTERVAL (WEEKDAY(CURRENT_DATE())) DAY) - INTERVAL ? WEEK 
                        AND 
                        (CURRENT_DATE() - INTERVAL (WEEKDAY(CURRENT_DATE())) DAY) - INTERVAL ? WEEK + INTERVAL 6 DAY', [$week, $week])
            ->where('rents.status', '!=', 'waiting')
            ->groupBy('weekday');
            if($agid)
                $query->where('agencies.id', '=', $agid);

            return $query->get();
    }
    
    public static function RentStatsRevenue(?int $week = null, ?int $agid, float $percentage = 0.95){

            $query =  DB::table('agencies')
            ->select(DB::raw("SUM(cars.price * TIMESTAMPDIFF(DAY,rents.startDate, rents.endDate) * $percentage)  AS rentPrice"))
            ->join('cars', 'cars.agency_id', '=', 'agencies.id')
            ->join('rents', 'rents.car_id', '=', 'cars.id')
            
            ->where('rents.status', '!=', 'waiting');
            if($week || $week === 0){
                $query->select(DB::raw('WEEKDAY(rents.startDate) AS weekday'), DB::raw("SUM(cars.price * TIMESTAMPDIFF(DAY,rents.startDate, rents.endDate) * $percentage)  AS rentPrice"))
                ->whereRaw('DATE(rents.startDate) >= (CURRENT_DATE() - INTERVAL (WEEKDAY(CURRENT_DATE())) DAY) - INTERVAL ? WEEK', [$week])
                ->whereRaw('DATE(rents.startDate) <= (CURRENT_DATE() - INTERVAL (WEEKDAY(CURRENT_DATE())) DAY) - INTERVAL ? WEEK + INTERVAL 6 DAY',[$week])
                ->groupBy(DB::raw('weekday'));
            }
            if($agid)
                $query->where('agencies.id', '=', $agid);
        return $query->get();
    }

}