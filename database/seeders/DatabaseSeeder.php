<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Department;
use App\Models\PriceBasis;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Supplier;
use App\Models\Tax;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('price_bases')->insert(PriceBasis::$price_bases);
        DB::table('deliveries')->insert(Delivery::$deliveries);
        DB::table('countries')->insert(Country::$countries);
        DB::table('taxes')->insert(Tax::$taxes);
        Department::factory(20)->create();
        Customer::factory(20)->create();
        Address::factory(20)->create();
        Contact::factory(20)->create();

        Supplier::factory(20)->create();
        Product::factory(20)->create();

        Quote::factory(20)->create();
        QuoteItem::factory(100)->create();

        foreach (Quote::all() as $quote) {
            $quote->generateReference();
        }
    }
}
