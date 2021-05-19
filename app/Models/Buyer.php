<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory, HasUUID;

    protected $table        = 'buyers';
    protected $primaryKey   = 'id';
    public $incrementing    = false;
    protected $keyType      = 'string';
    protected $fillable     = ['id','car_id','name','email','phone','purchasing_price'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
