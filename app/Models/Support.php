<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_care_id",
        "employer_id"
    ];

    public function customerCare()
    {
        return $this->belongsTo(CustomerCare::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
