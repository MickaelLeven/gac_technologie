<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest {
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        
        return true;    
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        
        return array(
            
            'account_invoice' => 'required', 
            'invoice_id' => 'required', 
            'customer_id' => 'required', 
            'date' => 'required', 
            'time' => 'required',
            'duration' => 'required', 
            'duration_invoice' => 'required', 
            'type' => 'required',
        );
    }
}