<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'firstname',
        'lastname',
        'email',
        'city',
        'postal_code',
        'user_id',
        'total',
        'address',
        'phone',
        'status',
    ]; 

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
