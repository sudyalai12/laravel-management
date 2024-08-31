<?php

use App\Models\Contact;
use App\Models\Delivery;
use App\Models\PriceBasis;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('price_bases', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Contact::class, 'contact_id')->constrained()->onDelete('cascade');
            $table->string('reference')->nullable();
            $table->foreignIdFor(PriceBasis::class, 'price_basis_id')->default(1)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Delivery::class, 'delivery_id')->default(1)->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Quote::class, 'quote_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Product::class, 'product_id')->constrained()->onDelete('cascade');
            $table->float('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
        Schema::dropIfExists('quote_items');
    }
};
