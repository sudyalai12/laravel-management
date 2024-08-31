<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Delivery;
use App\Models\PriceBasis;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    public function index(): \Illuminate\Contracts\View\View
    {
        $quotes = Quote::orderBy('updated_at', 'desc')->get();
        return view('quotes.index', compact('quotes'));
    }

    public function create(Request $request): \Illuminate\Contracts\View\View
    {
        $contact = Contact::find($request->contact);
        return view('quotes.create', compact('contact'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'customer' => 'required|exists:customers,name',
            'contact' => 'required|exists:contacts,name',
            'product' => 'required|exists:products,name',
            'quantity' => 'required|numeric|min:1|max:100',
        ]);

        $contact = Contact::where('name', $validate['contact'])
            ->whereHas('address.customer', function ($query) use ($validate) {
                $query->where('name', $validate['customer']);
            })
            ->first();
        if (!$contact) {
            return back()->withErrors(['contact' => 'The selected contact is not associated with the selected customer.']);
        }

        $product = Product::where('name', $validate['product'])->first();
        $quote = Quote::create([
            'contact_id' => $contact->id,
        ]);
        $quote->reference = $quote->contact->address->customer->generateReference();
        $quote->save();
        $quote->items()->create([
            'product_id' => $product->id,
            'quantity' => $validate['quantity'],
        ]);
        return redirect("/quotes/{$quote->id}");
    }

    public function show(Quote $quote): \Illuminate\Contracts\View\View
    {
        $priceBasis = PriceBasis::get()->pluck('description');
        $deliveries = Delivery::get()->pluck('description');
        return view('quotes.show', compact('quote', 'priceBasis', 'deliveries'));
    }

    public function edit() {}

    public function update(Quote $quote, Request $request): \Illuminate\Http\JsonResponse
    {
        $priceBasis = $request->price_basis;
        $delivery = $request->delivery;
        $priceBasis = PriceBasis::where('description', $priceBasis)->first();
        $delivery = Delivery::where('description', $delivery)->first();
        $quote->delivery()->associate($delivery);
        $quote->priceBasis()->associate($priceBasis);
        $quote->save();
        return response()->json($request->all());
    }

    public function destroy() {}

    public function storeItem(Request $request, Quote $quote): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'product' => ['required', 'exists:products,name'],
            'quantity' => ['required', 'numeric', 'min:1', 'max:100'],
        ]);

        $product = Product::where('name', $validate['product'])->first();
        $quoteItem = $quote->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => $quote->items()->where('product_id', $product->id)->value('quantity') + $request->quantity]
        );
        return redirect("/quotes/{$quote->id}");
    }

    public function destroyItem(Quote $quote, QuoteItem $quoteItem): \Illuminate\Http\RedirectResponse
    {
        $quoteItem->delete();
        return redirect("/quotes/{$quote->id}");
    }
}
