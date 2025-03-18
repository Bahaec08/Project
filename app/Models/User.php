<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'type',
        'picture',
        'email_verified_at',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rent():HasMany
    {
        return $this->hasMany(Rent::class);
    }

    public function review():HasMany
    {
        return $this->hasMany(Review::class);
    }
    
    public function scopeActiveUser($query)
    {
        return $query->join('rents', 'users.id', '=', 'rents.user_id')
        ->select('users.id')
        ->distinct();
    }

        
    public function scopeRentedBy($query, int $carid)
    {
        return $query->selectRaw('users.id as uid, concat(users.firstName," ",users.lastName) as fullName, users.picture, reviews.description, reviews.rating')
            ->join('reviews', 'reviews.user_id', '=', 'users.id')
            ->where('reviews.car_id', '=', $carid)
            ->get();
    }

    static function UserRents(int $agid = 0){
        return DB::table('users')
            ->join('rents', 'rents.user_id', 'users.id')
            ->join('cars', 'cars.id', 'rents.car_id')
            ->where('cars.agency_id', '=', $agid)
            ->distinct()
            ->select('users.id')
            ->get();
    }
}
