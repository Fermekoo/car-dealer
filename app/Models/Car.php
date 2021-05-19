<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory, HasUUID;

    protected $table        = 'cars';
    protected $primaryKey   = 'id';
    public $incrementing    = false;
    protected $keyType      = 'string';
    protected $fillable     = ['id','name','price','stock'];

    public function buyers()
    {
        return $this->hasMany(Buyer::class, 'car_id');
    }
}
