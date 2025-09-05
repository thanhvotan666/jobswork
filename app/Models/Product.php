<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'price_discount',
        'quantity',
        'is_gem',
        'service_id'
    ];
    protected $casts = [
        'is_gem' => 'boolean',
        'price' => 'integer',
        'price_discount' => 'integer',
        'quantity' => 'integer',
        'service_id' => 'integer'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function getNumber($value)
    {
        return number_format($value, 0, ',', '.');
    }
}
