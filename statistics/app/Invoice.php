<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    public $timestamps = false;
    
    const PAID = 3;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id', 'name', 'description', 'number', 'note', 'date',
        'invoice_term_id', 'due_date', 'created_at', 'created_by', 'school_year_id', 'school_id',
        'bill_to_id', 'ship_to_id', 'subtotal', 'markup_fee', 'markup_percentage', 'tax', 'shipping_fee','fund_source_id',
        'total_amount', 'invoice_status_id', 'payment_status_id', 'payment_type_id', 'invoice_type_id','allocation_type_id','memo','campus_id',
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lineItem()
    {
        return $this->hasMany('App\InvoiceLineItem', 'invoice_id','id')->with('budget');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function allocation()
    {
        return $this->hasOne('App\AllocationType', 'id','allocation_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fundSource()
    {
        return $this->hasOne('App\FundSource', 'id','fund_source_id');
    }
    
        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoiceTerm()
    {
        return $this->hasOne('App\InvoiceTerm', 'id','invoice_term_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentStatus()
    {
        return $this->hasOne('App\PaymentStatus', 'id','payment_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->hasOne('App\School', 'id','school_id');
    }
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->hasOne('App\Address', 'id','bill_to_id')->with('state');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campus()
    {
        return $this->hasOne('App\Campus', 'id','campus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentType()
    {
        return $this->hasOne('App\PaymentType', 'id','payment_type_id'); //, 'id','payment_type_id'
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoiceType()
    {
        return $this->hasOne('App\InvoiceType', 'id','invoice_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoiceStatus()
    {
        return $this->hasOne('App\InvoiceStatus', 'id','invoice_status_id');
    }

}
