<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;


    protected $fillable = [
        'carMark',
        'carModel',
        'consumption',
        'Kilometrage',
        'Gearbox',
        'petrolType',
        'price',
        'photo',
        'nofplaces',
        'agency_id'
    ];

    public function rent():HasMany
    {
        return $this->hasMany(Rent::class);
    }

    public function review():HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function agency():BelongsTo
    {
        return $this->belongsto(Agency::class);
    }

    public static function RentableCars(?string $date, ?string $location = null, ?int $uid)
    {
    
        $query = DB::table('cars')
        ->selectRaw('cars.*')
        ->leftJoin('rents', 'cars.id', '=', 'rents.car_id')
        ->join('agencies', 'agencies.id', '=', 'cars.agency_id');
        if($uid !== null){        

            $query->selectRaw('IF(favorites.user_id is Not Null, true, false) AS fav')
            ->leftJoin('favorites', function ($join) use ($uid) {
            $join->on('favorites.car_id', '=', 'cars.id')
                 ->where('favorites.user_id', '=', $uid);
        });
        }
        $query->where(function ($query) use ($date) {
            $query->whereRaw('? NOT BETWEEN rents.startDate AND rents.endDate', [(string) $date])
                  ->orWhereNull('rents.startDate');
        });
        if($location){
            $query->where('agencies.location','=',  $location);
        }
        return $query->get();
    }

    public function scopeCarRents($query, int $carID)
    {
        return $query->select('cars.*')
            ->join('rents', 'cars.id', '=', 'rents.car_id')
            ->where('cars.id' , '=', $carID)->get();
    }


    // ->orderBy('endDate')->limit(1)
    public function scopeLastCarRents($query, int $carID)
    {
        return $query->select('cars.*')
            ->join('rents', 'cars.id', '=', 'rents.car_id')
            ->where('cars.id' , '=', $carID)
            ->select('rents.*')
            ->orderBy('rents.endDate')->limit(1)->get();
    }
    
    public static function RecCars(?string $uid ){
        $query = DB::table('cars')
        ->selectRaw('cars.*, IF(favorites.user_id is Not Null, true, false) AS fav')
        ->leftJoin('favorites', function ($join) use ($uid) {
            $join->on('favorites.car_id', '=', 'cars.id')
                 ->where('favorites.user_id', '=', $uid);
        });
        return $query->get();
    }

    public static function RentedBy(?int $carid, $userid)
    {
        return DB::table('users')
            ->join('rents', function ($join) use ($carid) {
                $join->on('users.id', '=', 'rents.user_id')
                    ->where('rents.car_id', '=', $carid)
                    ->where('rents.status' , '=' ,'success');
            })
            ->where('users.id', '=', $userid)
            
            ->count();
    }
}
