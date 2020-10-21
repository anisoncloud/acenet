<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'package_name', 'billing_name',
        'customer_nid', 'billing_apartment', 'billing_email', 'billing_phone', 'billing_zone', 'payement_gateway', 'billing_subtotal', 'billing_total',
                    'error',
                    'house',
                    'gander',
                    'road',
                    'block',
                    'area',
                    'city',
                    'post_code',
                    'connectivity_date',
                    'note',
                    'service_plan',
                    'bkash_response',
                    'customer_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
