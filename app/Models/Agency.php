<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

class Agency extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = [
        'nofcars',
        'nofrents'
    ];

    protected $fillable = [
        'agencyName',
        'ownerName',
        'phone',
        'email',
        'password',
        'location',
        'license',
        'status'
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'updated_at'
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];


    public function car() : HasMany
    {
        return $this->hasMany(Car::class);
    }



    public function rents(): HasManyThrough{
        return $this->hasManyThrough(Rent::class, Car::class);
    }

    public function option() : HasMany
    {
        return $this->hasMany(Option::class);
    }

    protected function nofcars() : Attribute
    {
        return new Attribute(
            get: fn () => $this->car->count()
        );
    }

    protected function nofrents() : Attribute
    {
        return new Attribute(
            get: fn () => $this->rents->count()
        );
    }


    public function scopeActive(Builder $query, string $parmams): void 
    {
        $query->where('status', '=', $parmams);
    }

    public static function listing(int $agid, string $status)
    {
        return DB::table('agencies')
        ->join('cars', 'agencies.id', '=', 'cars.agency_id')
        ->join('rents', 'cars.id', '=', 'rents.car_id')
        ->join('users', 'users.id', '=', 'rents.user_id')
        ->where('agencies.id', $agid)
        ->where('rents.status', $status)
        ->select('rents.id as rentID', 'rents.startDate', 'rents.endDate', 'users.id', 'users.firstName', 'users.lastName', 'users.picture', 'cars.id as carId', 'cars.carmodel', 'cars.photo')
        ->get();
    }

    
}
