<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create (Listing $listing) 
    {

        $listing->load(['images']);
        return Inertia::render(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store (Listing $listing, Request $request) 
    {
        if ($request->hasFile('images')) {

            $request->validate([
                    'images.*' => 'mimes:jpg,png,jpeg|max:5000'
                ],
                [
                    'images.*.mimes' => 'The files should be jpg, png and lests 5MB'
                ]
            );

            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
        }

        return redirect()->back()->with('success', 'Images uploaded!');
    }

    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }

}
