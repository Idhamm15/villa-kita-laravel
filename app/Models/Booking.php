<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'booking_code',
        'order_id',
        'product_id',
        'user_id',
        'name_guest',
        'email',
        'phone',
        'check_in',
        'check_out',
        'total_guest',
        'discount',
        'total_price',
        'status',
        'visitor_type',
        'payment_method',
        'payment_status',
        'payment_token',
        'payment_url',
        'paid_at',
        'expired_at',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
   
}
