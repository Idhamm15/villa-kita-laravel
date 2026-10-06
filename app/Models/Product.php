<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'owner_id',
        'name',
        'thumbnail',
        'description',
        'type',
        'location',
        'address',
        'url_maps',
        'booking_type',
        'service_fee',
        'created_by',
        'total_bedroom',
        'total_bathroom',
        'max_guest',
        'wide',
        'price_start',
        'price',
        'slug',
        'type_unit',
        'stock',
        'capacity',
        'is_active',    
        'created_by',    
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class, 'product_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');       
    }
}
