<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'employer_id',
        'employer_name',
        'employer_email',
        'employer_phone',
        'name',
        'type',
        'locale',
        'amount',
        'bankCode',
        'is_paid'
    ];
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
