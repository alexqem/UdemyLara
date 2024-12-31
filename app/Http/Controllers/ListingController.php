<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Listing;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {

        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        
        return Inertia::render('Listing/Index', [

           'filters' => $filters,

           'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)
                ->withQueryString()
        ]);
    }


    public function show(Listing $listing)
    {

        $listing->load(['images']);

        $offer = !Auth::user() ?  null : $listing->offers()->byMe()->first();
        
        return Inertia::render('Listing/Show', [
            'listing' => $listing,
            'offerMade' => $offer
        ]);
    }

    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();

    //     return redirect()->back()->with('success', 'Listing was deleted');
    // }
}
