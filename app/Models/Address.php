<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'user_addresses';
    protected $fillable = [
        'name' ,
        'user_id',
        'address_line1',
        'address_line2',
        'city',
        'postal_code',
        'country',
        'telephone',
        'mobile'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
