<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'pickup_address', 'pickup_name', 'pickup_contact_no', 'pickup_email',
        'delivery_address', 'delivery_name', 'delivery_contact_no',
        'delivery_email', 'type_of_good', 'delivery_provider', 'priority',
        'shipment_pickup_date', 'shipment_pickup_time','delivery_status'
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}
