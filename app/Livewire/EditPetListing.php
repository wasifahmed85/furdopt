<?php

namespace App\Livewire;

use App\Jobs\ProcessPetImagesJob;
use App\Models\Category;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\SubCategory;
use App\Models\UkState;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class EditPetListing extends Component
{
    use WithFileUploads;

    #[Title('Pet Listing Edit')]

    public $showPriceType = 1, $showPriceRange = 0, $showPrice = 1;
    public $imageDeleteError;

    // Main fields
    public $pet_id, $petthumbnail;
    public $category_id, $sub_category_id, $name, $gender, $age, $size, $location, $about;
    public $meta_title, $meta_description, $meta_keywords;
    public $price, $description, $status, $price_type, $price_from, $price_to;
    public $feature_list, $health_guarantee, $pet_insurance, $map_link, $sports;
    public $size_seeking, $special_need, $special_details;
    public $iscomportable_other_pet, $iscomportable_children, $why_rehome;
    public $best_fit_for_home, $best_fit_for_home_deatils, $need_outdoor_space;
    public $iscomportable_details, $uk_state_id;
    public $owners = [], $categories = [], $states = [], $subCategories = [], $subCategoriesEdit = [];
    public $petimages;

    // Image uploads
    #[Validate(['images.*' => 'nullable|image|max:10240'])]
    public $images = [];
    public $temporaryImages = [];
    public array $newImages = [];

    // Health & personality
    public $microchipped_status, $neutered_status, $vaccinations_status, $worm_status, $health_checked;
    public $special_medical_care, $registered, $website_link, $personality, $weight, $colour, $dob;
    public $pet_listing_type, $charity_name, $specific_activities;
    public $iscomportable_other_pet_cat, $iscomportable_others_pets, $iscomportable_other_pet_cat_details;

    protected $rules = [
        'category_id' => 'required',
        'uk_state_id' => 'required',
        'sub_category_id' => 'required',
        'name' => 'required|min:3',
        'gender' => 'required|in:Male,Female,Unknown',
        'age' => 'required',
        'price' => 'required|numeric|min:10|max:600',
        'description' => 'required',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        'size' => 'required',
        'colour' => 'required',

        'weight' => 'nullable|numeric',
        'personality' => 'required',
        'iscomportable_other_pet' => 'required',
        'iscomportable_other_pet_cat' => 'required',
        'iscomportable_others_pets' => 'required',
        'iscomportable_children' => 'required',
        'best_fit_for_home' => 'required',
        'need_outdoor_space' => 'required',
        'images' => 'nullable|array|min:1',

    ];

    public function messages()
    {
        return [
            'price.min' => 'Minimum adoption fee is £10.',
            'price.numeric' => 'The adoption fee must be a number.',
            'price.required' => 'The adoption fee is required.',
            'images.*.max' => 'Maximum image size is 10 MB.',
            'images.*.image' => 'Only valid image files are allowed.',
        ];
    }

    public function mount($id)
    {
        $pet = Pet::findOrFail($id);
        $this->pet_id = $pet->id;
        $this->petthumbnail = $pet->thumbnail;

        $this->category_id = $pet->category_id;
        $this->sub_category_id = $pet->sub_category_id;
        $this->name = $pet->name;
        $this->age = $pet->age;
        $this->size = $pet->size;
        $this->location = $pet->location;
        $this->gender = $pet->gender;
        $this->price = $pet->price;
        $this->description = $pet->description;
        $this->price_type = $pet->price_type;
        $this->status = $pet->status;
        $this->price_from = $pet->price_from;
        $this->price_to = $pet->price_to;
        $this->feature_list = $pet->feature_list;

        // Health
        $this->microchipped_status = $pet->microchipped_status;
        $this->neutered_status = $pet->neutered_status;
        $this->vaccinations_status = $pet->vaccinations_status;
        $this->worm_status = $pet->worm_status;
        $this->health_checked = $pet->health_checked;
        $this->registered = $pet->registered;
        $this->health_guarantee = $pet->health_guarantee;
        $this->pet_insurance = $pet->pet_insurance;

        // Other
        $this->uk_state_id = $pet->uk_state_id;
        $this->sports = $pet->sports;
        $this->map_link = $pet->map_link;
        $this->website_link = $pet->website_link;

        $this->categories = Category::where('status', 1)->get(['id', 'name']);
        $this->states = UkState::orderBy('state', 'ASC')->get(['id', 'state']);
        $this->subCategoriesEdit = SubCategory::where('status', 1)->get(['id', 'name']);
        $this->petimages = PetImage::where('pet_id', $pet->id)->get();

        $this->special_need = $pet->special_need;
        $this->special_details = $pet->special_details;
        $this->iscomportable_other_pet = $pet->iscomportable_other_pet;
        $this->iscomportable_children = $pet->iscomportable_children;
        $this->why_rehome = $pet->why_rehome;
        $this->best_fit_for_home = $pet->best_fit_for_home;
        $this->best_fit_for_home_deatils = $pet->best_fit_for_home_deatils;
        $this->need_outdoor_space = $pet->need_outdoor_space;
        $this->special_medical_care = $pet->special_medical_care;
        $this->weight = $pet->weight;
        $this->colour = $pet->colour;
        $this->dob = $pet->dob;
        $this->pet_listing_type = $pet->pet_listing_type;
        $this->charity_name = $pet->charity_name;
        $this->specific_activities = $pet->specific_activities;
        $this->personality = $pet->personality;
        $this->iscomportable_other_pet_cat = $pet->iscomportable_other_pet_cat;
        $this->iscomportable_others_pets = $pet->iscomportable_others_pets;
        $this->iscomportable_other_pet_cat_details = $pet->iscomportable_other_pet_cat_details;
    }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
        $this->sub_category_id = '';
    }

    public function imageDelete($id)
    {
        $petImage = PetImage::findOrFail($id);
        $petImageCount = PetImage::where('pet_id', $petImage->pet_id)->count();

        if ($petImageCount > 1) {
            if (File::exists(public_path('images/' . $petImage->image))) {
                File::delete(public_path('images/' . $petImage->image));
            }
            $petImage->delete();
            $this->petimages = PetImage::where('pet_id', $this->pet_id)->get();
        } else {
            $this->imageDeleteError = 'At least one image is required!';
        }
    }

    public function updatedNewImages()
    {
        foreach ($this->newImages as $file) {
            $this->images[] = $file;
        }
        $this->reset('newImages');
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function UpdateData()
    {
        $this->validate();

        $pet = Pet::findOrFail($this->pet_id);
        $pet->update([
            // 'owner_id' => Auth::id(),
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'name' => $this->name,
            'age' => $this->age,
            'size' => $this->size,
            'location' => $this->location,
            'about' => $this->about,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'gender' => $this->gender,
            'price' => $this->price,
            'description' => $this->description,
            'price_type' => $this->price_type,
            'status' => $this->status,
            'price_from' => $this->price_from, // Corrected
            'price_to' => $this->price_to,     // Corrected
            // 'ad_type' => 'rehome',
            'feature_list' => $this->feature_list,
            'microchipped_status' => $this->microchipped_status,
            'neutered_status' => $this->neutered_status,
            'vaccinations_status' => $this->vaccinations_status,
            'worm_status' => $this->worm_status,
            'health_checked' => $this->health_checked,
            'special_medical_care' => $this->special_medical_care,
            'registered' => $this->registered,
            'health_guarantee' => $this->health_guarantee,
            'pet_insurance' => $this->pet_insurance,
            'uk_state_id' => $this->uk_state_id,
            'map_link' => $this->map_link,
            'website_link' => $this->website_link,
            'personality' => $this->personality,
            // 'personality' => json_encode($this->personality),
            'sports' => $this->sports,
            'weight' => $this->weight,
            'colour' => $this->colour,
            'dob' => $this->dob,
            'pet_listing_type' => $this->pet_listing_type,
            'charity_name' => $this->charity_name,
            'size_seeking' => $this->size_seeking,
            'special_need' => $this->special_need,
            'special_details' => $this->special_details,
            'iscomportable_other_pet' => $this->iscomportable_other_pet,
            'iscomportable_details' => $this->iscomportable_details,
            'iscomportable_children' => $this->iscomportable_children,
            'why_rehome' => $this->why_rehome,
            'best_fit_for_home' => $this->best_fit_for_home,
            'best_fit_for_home_deatils' => $this->best_fit_for_home_deatils,
            'need_outdoor_space' => $this->need_outdoor_space,
            'specific_activities' => $this->specific_activities,
            'iscomportable_other_pet_cat' => $this->iscomportable_other_pet_cat,
            'iscomportable_others_pets' => $this->iscomportable_others_pets,
            'iscomportable_other_pet_cat_details' => $this->iscomportable_other_pet_cat_details,
        ]);

        // // Save new images
        // if (!empty($this->images)) {
        //     $manager = new ImageManager(new Driver());

        //     foreach ($this->images as $img) {
        //         if ($img && $img->getRealPath()) {
        //             $imageName = uniqid() . '.webp';
        //             $image = $manager->read($img->getRealPath())->toWebp(100);
        //             file_put_contents(public_path('images/' . $imageName), (string)$image);

        //             PetImage::create([
        //                 'pet_id' => $pet->id,
        //                 'image' => $imageName
        //             ]);
        //         }
        //     }
        // }

        if (!empty($this->images)) {
            $imageData = [];

            foreach ($this->images as $img) {
                $tempPath = $img->store('', 'livewire-tmp');
                $imageData[] = ['temp_path' => $tempPath];
            }
            // Dispatch job to process images
            ProcessPetImagesJob::dispatch($pet->id, $imageData);
        }


        session()->flash('message', 'Data updated successfully!');
        $this->reset(['images', 'newImages', 'temporaryImages']);
        return $this->redirect('/pet/listing');
    }

    public function SelectPrice()
    {
        $this->showPrice = 1;
        $this->showPriceType = 1;
        $this->showPriceRange = 0;
    }
    public function SelectPriceRange()
    {
        $this->showPrice = 0;
        $this->showPriceType = 1;
        $this->showPriceRange = 1;
    }
    public function SelectDisable()
    {
        $this->showPrice = 0;
        $this->showPriceType = 0;
        $this->showPriceRange = 0;
    }

    public function render()
    {
        return view('livewire.edit-pet-listing');
    }
}
