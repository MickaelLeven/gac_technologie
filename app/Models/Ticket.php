<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    
    /**
     * Name of table
     * @var string
     */
    protected $table = "tickets";
    
    
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = array(
        
        'account_invoice', 'invoice_id', 'customer_id', 'date', 
        'time', 'duration', 'duration_invoice', 'weight', 'weight_invoice', 'type',
    );
    
    
    /**
     * The attribute wich include creation and update datetimes
     * @var boolean
     */
    public $timestamps = true;
}