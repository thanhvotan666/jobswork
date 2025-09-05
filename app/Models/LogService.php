<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogService extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "employer_id",
        "service_id",
        "expired",
        "start",
        "quantity"
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
