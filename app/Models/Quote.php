<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $table = 'quotes';
    protected $guarded = [];
    protected $with = ['contact', 'priceBasis', 'delivery'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function priceBasis()
    {
        return $this->belongsTo(PriceBasis::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function generateReference()
    {
        $this->reference = $this->contact->address->customer->generateReference();
        $this->save();
    }

    public function total()
    {
        return $this->items->sum->total();
    }

    public function totalWithTax($tax = 0.18)
    {
        return $this->total() * $tax;
    }

    public function grandTotal()
    {
        return $this->total() + $this->totalWithTax();
    }
}
