<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modell extends Model
{
    use HasFactory;

    protected $table = 'models';

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
