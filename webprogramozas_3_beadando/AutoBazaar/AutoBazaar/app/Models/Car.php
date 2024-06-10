<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'title',
        'description',
        'price',
        'user_id',
        'brand_id',
        'type',
        'model_id',
        'condition_id',
        'year',
        'odometer',
        'engine',
        'fuel_id',
        'cylindercapacity',
        'horsepower',
        'transmission_id',
        'picture'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function modell()
    {
        return $this->belongsTo(Modell::class);
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function extras(){
        return $this->belongsToMany(Extra::class);
    }
}
