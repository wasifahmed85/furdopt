<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\SubCategory;
use App\Models\UkState;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\PetListingPublishedMail;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        Gate::authorize('pet_access');
        $pets = Pet::latest()->orderBy('isPublished', 'ASC')->get();
        return view('backend.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('pet_create');
        $users = User::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $states = UkState::all();

        return view('backend.pets.form', compact('users', 'categories', 'subCategories', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('pet_create');
        $validated = $request->validate([

            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required|string|max:255',
            'gender' => 'required',

            'age' => 'required',
            'size' => 'required',
            'uk_state_id' => 'required|string|max:255',

            // 'price' => 'required|numeric',

        ]);



        $store = Pet::create([
            'owner_id' => Auth::id(),
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'charity_name_admin' => $request->charity_name_admin,
            'age' => $request->age,
            'weight' => $request->weight,
            'size' => $request->size,
            // 'uk_state_id' => $request->uk_state_id,
            'about' => $request->about,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'gender' => $request->gender,
            'colour' => $request->colour,
            'dob' => $request->dob,
            'price' => $request->price ?? '0',
            'description' => $request->description,
            'price_type' => $request->price_type,
            'status' => $request->status,
            'price_from' => $request->price_from,
            'price_to' => $request->price_to,
            'dedicated_time' => $request->dedicated_time,
            'special_need' => $request->special_need,
            'special_details' => $request->special_details,
            'ad_type' => 'Rehome a Pet',
            'feature_list' => $request->feature_list,
            'microchipped_status' => $request->microchipped_status,
            'neutered_status' => $request->neutered_status,
            'vaccinations_status' => $request->vaccinations_status,
            'worm_status' => $request->worm_status,
            'health_checked' => $request->health_checked,
            'registered' => $request->registered,
            'health_guarantee' => $request->health_guarantee,
            'pet_insurance' => $request->pet_insurance,
            'uk_state_id' => $request->uk_state_id,
            'map_link' => $request->map_link,
            'website_link' => $request->website_link,
            'personality' => $request->personality,
            'iscomportable_other_pet' => $request->iscomportable_other_pet,
            'iscomportable_details' => $request->iscomportable_details,
            'iscomportable_other_pet_cat' => $request->iscomportable_other_pet_cat,
            'iscomportable_other_pet_cat_details' => $request->iscomportable_other_pet_cat_details,
            'iscomportable_others_pets' => $request->iscomportable_others_pets,
            'iscomportable_others_pet_details' => $request->iscomportable_others_pet_details,
            'iscomportable_children' => $request->iscomportable_children,
            'why_rehome' => $request->why_rehome,
            'best_fit_for_home' => $request->best_fit_for_home,
            'best_fit_for_home_deatils' => $request->best_fit_for_home_deatils,
            'need_outdoor_space' => $request->need_outdoor_space,
            'special_medical_care' => $request->special_medical_care,


        ]);
        $randomNo = Str::random(6);

        $manager = new ImageManager(new Driver());


        Pet::find($store->id)->update([

            'advert_id' => $randomNo . $store->id,
        ]);

        $manager = new ImageManager(new Driver());
        
              if ($request->images) {
            $thumbnailName = uniqid() . '.webp'; 
            $image = $manager->read($request->images[0]->getRealPath())
                // ->cover(870, 493) 
                ->toWebp(100); 

            // Storage::disk('public')->put('images/' . $thumbnailName, (string) $image);
            $imagePath = public_path('images/' . $thumbnailName);
            file_put_contents($imagePath, (string) $image);

            $store->update([
                'advert_id' => $randomNo . $store->id,
                'thumbnail' => $thumbnailName
            ]);
        }

        
        if (!empty($request->images)) {


            foreach ($request->images as $img) {
                $imageName = uniqid() . '.webp'; // Save as WebP

                $image = $manager->read($img->getRealPath())
                    // ->cover(870, 493) // Resize & crop to 800x800
                    ->toWebp(90); // Convert to WebP with 90% quality

                // Storage::disk('public')->put('images/' . $imageName, (string) $image);
                $imagePath = public_path('images/' . $imageName);
                file_put_contents($imagePath, (string) $image);
                PetImage::create([
                    'pet_id' => $store->id,
                    'image' => $imageName
                ]);
            }
        }

        flash('Pet Listing Successfully Updated.');

        return redirect()->route('admin.pets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        Gate::authorize('pet_view');
        $users = User::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $states = UkState::all();
        $petimages = PetImage::where('pet_id', $pet->id)->get();

        return view('backend.pets.show', compact('users', 'categories', 'subCategories', 'pet', 'states', 'petimages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        Gate::authorize('pet_edit');
        $users = User::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $states = UkState::all();
        $petimages = PetImage::where('pet_id', $pet->id)->get();

        return view('backend.pets.form_edit', compact('users', 'categories', 'subCategories', 'pet', 'states', 'petimages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        Gate::authorize('pet_edit');
        $validated = $request->validate([

            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'gender' => 'required',

            'age' => 'required',
            'size' => 'required',
            'uk_state_id' => 'required|string|max:255',

            // 'price' => 'required|numeric',

        ]);
        if (!empty($request->images)) {
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxFileSize = 5 * 1024 * 1024;
            foreach ($request->images as $img) {
                if (!in_array($img->getMimeType(), $allowedMimeTypes)) {
                    throw new \Exception('Invalid file type.');
                }
                if ($img->getSize() > $maxFileSize) {
                    return back()->with('errors', 'File size exceeds the allowed limit.');
                }
            }
        }

        $pet->update([
            // 'category_id' => $request->category_id,
            // 'sub_category_id' => $request->sub_category_id,
            // 'name' => $request->name,
            // 'age' => $request->age,
            // 'size' => $request->size,
            // // 'location' => $request->location,
            // 'about' => $request->about,
            // 'meta_title' => $request->meta_title,
            // 'meta_description' => $request->meta_description,
            // 'meta_keywords' => $request->meta_keywords,
            // 'gender' => $request->gender,
            // 'price' => $request->price,
            // 'description' => $request->description,
            // 'price_type' => $request->price_type,
            // 'status' => $request->status,
            // 'price_from' => $request->price_from,
            // 'price_to' => $request->price_to,
            // 'feature_list' => $request->feature_list,
            // 'microchipped_status' => $request->microchipped_status,
            // 'neutered_status' => $request->neutered_status,
            // 'vaccinations_status' => $request->vaccinations_status,
            // 'worm_status' => $request->worm_status,
            // 'health_checked' => $request->health_checked,
            // 'registered' => $request->registered,
            // 'health_guarantee' => $request->health_guarantee,
            // 'pet_insurance' => $request->pet_insurance,
            // 'uk_state_id' => $request->uk_state_id,
            // 'map_link' => $request->map_link,
            // 'website_link' => $request->website_link,
            //  'dedicated_time' => $request->dedicated_time,
            // 'special_need' => $request->special_need,
            // 'special_details' => $request->special_details,
            // 'personality' => json_encode($request->personality),
            // 'iscomportable_other_pet' => $request->iscomportable_other_pet,
            // 'iscomportable_details' => $request->iscomportable_details,
            // 'iscomportable_other_pet_cat' => $request->iscomportable_other_pet_cat,
            // 'iscomportable_other_pet_cat_details' => $request->iscomportable_other_pet_cat_details,
            // 'iscomportable_others_pets' => $request->iscomportable_others_pets,
            // 'iscomportable_others_pet_details' => $request->iscomportable_others_pet_details,
            // 'iscomportable_children' => $request->iscomportable_children,
            // 'why_rehome' => $request->why_rehome,
            // 'best_fit_for_home' => $request->best_fit_for_home,
            // 'best_fit_for_home_deatils' => $request->best_fit_for_home_deatils,
            // 'need_outdoor_space' => $request->need_outdoor_space,
            // 'special_medical_care' => $request->special_medical_care,
              'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'charity_name_admin' => $request->charity_name_admin,
            'age' => $request->age,
            'weight' => $request->weight,
            'size' => $request->size,
            // 'uk_state_id' => $request->uk_state_id,
            'about' => $request->about,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'gender' => $request->gender,
            'colour' => $request->colour,
            'dob' => $request->dob,
            'price' => $request->price ?? '0',
            'description' => $request->description,
            'price_type' => $request->price_type,
            'status' => $request->status,
            'price_from' => $request->price_from,
            'price_to' => $request->price_to,
            'dedicated_time' => $request->dedicated_time,
            'special_need' => $request->special_need,
            'special_details' => $request->special_details,
            'ad_type' => 'Rehome a Pet',
            'feature_list' => $request->feature_list,
            'microchipped_status' => $request->microchipped_status,
            'neutered_status' => $request->neutered_status,
            'vaccinations_status' => $request->vaccinations_status,
            'worm_status' => $request->worm_status,
            'health_checked' => $request->health_checked,
            'registered' => $request->registered,
            'health_guarantee' => $request->health_guarantee,
            'pet_insurance' => $request->pet_insurance,
            'uk_state_id' => $request->uk_state_id,
            'map_link' => $request->map_link,
            'website_link' => $request->website_link,
            'personality' => $request->personality,
            'iscomportable_other_pet' => $request->iscomportable_other_pet,
            'iscomportable_details' => $request->iscomportable_details,
            'iscomportable_other_pet_cat' => $request->iscomportable_other_pet_cat,
            'iscomportable_other_pet_cat_details' => $request->iscomportable_other_pet_cat_details,
            'iscomportable_others_pets' => $request->iscomportable_others_pets,
            'iscomportable_others_pet_details' => $request->iscomportable_others_pet_details,
            'iscomportable_children' => $request->iscomportable_children,
            'why_rehome' => $request->why_rehome,
            'best_fit_for_home' => $request->best_fit_for_home,
            'best_fit_for_home_deatils' => $request->best_fit_for_home_deatils,
            'need_outdoor_space' => $request->need_outdoor_space,
            'special_medical_care' => $request->special_medical_care,
        ]);

        $manager = new ImageManager(new Driver());


        $images = $request->images;

        if (!empty($images)) {


            // // Delete old images
            // $oldImages = PetImage::where('pet_id', $pet->id)->get();
            // foreach ($oldImages as $oldi) {
            //     $path = public_path('images/') . $oldi->image;
            //     if (file_exists($path)) {
            //         unlink($path);
            //     }
            //     $oldi->delete(); // Remove from DB
            // }
            $manager = new ImageManager(new Driver());

            foreach ($request->images as $img) {
                $imageName = uniqid() . '.webp'; // Save as WebP

                $image = $manager->read($img->getRealPath())
                    // ->cover(870, 493) // Resize & crop to 800x800
                    ->toWebp(100); // Convert to WebP with 90% quality

                // Storage::disk('public')->put('images/' . $imageName, (string) $image);
                $imagePath = public_path('images/' . $imageName);
                file_put_contents($imagePath, (string) $image);
                PetImage::create([
                    'pet_id' => $pet->id,
                    'image' => $imageName
                ]);
            }
        }

        flash('Pet Listing Successfully Updated.');

        return redirect()->route('admin.pets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        Gate::authorize('pet_delete');
        $images = PetImage::where('pet_id', $pet->id)->get();
        foreach ($images as $oldi) {
            $path = public_path('images/') . $oldi->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $oldi->delete();
        }

        if ($pet->thumbnail) {
            $path = ('images/') . $pet->thumbnail;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $pet->delete();
        flash('Pet Listing Successfully Deleted.');

        return redirect()->route('admin.pets.index');
    }

    public function publishedStatusChange(Request $request)
    {
        $pet = Pet::findorfail($request->pet_id);
        $pet->update(['isPublished' => $request->published_status]);
        flash('Published Status Change Successfully.');
        
        // if($request->published_status ==1)
        // {
        // $email = $pet->user->email;
        // $user = $pet->user->name;
        //  Mail::to($email)->send(new PetListingPublishedMail($user));
        // }
        return back();
    }
    
    public function imageDelete($id)
    {
         $image = PetImage::findorfail($id);
            $path = public_path('images/') . $image->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $image->delete();
        return back();
    }
}
