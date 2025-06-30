<?php

namespace App\Livewire;

use App\Jobs\ProcessPetImagesJob;
use App\Jobs\SendPetListingEmailsJob;
use App\Models\Category;
use App\Models\User;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\SubCategory;
use App\Models\UkState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;
use App\Mail\NewPetListingEmail;
use App\Mail\PetListingPublishedMail;

class AddPetListing extends Component
{
    use WithFileUploads;


    #[Title(' Pet Listing Add')]
    public $showPriceType = 1;
    public $showPriceRange = 0;
    public $showPrice = 1;

    public $states;
    public $owner_id;
    public $category_id;
    public $sub_category_id;
    public $name;
    public $gender;
    public $age;
    public $size;
    public $location;
    public $about;

    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $price;
    public $description;
    public $status;
    public $price_type;
    public $price_from;
    public $price_to;
    public $ad_type;
    public $tag;
    public $feature_list;
    public $health_guarantee;
    public $pet_insurance;
    public $map_link;
    public $sports;
    public $size_seeking;
    public $special_need;
    public $special_details;
    public $iscomportable_other_pet;
    public $iscomportable_children;
    public $why_rehome;
    public $best_fit_for_home;
    public $best_fit_for_home_deatils;
    public $need_outdoor_space;

    public $iscomportable_details;
    public $uk_state_id;

    // #[Validate('image|required|max:1024')]
    // public $thumbnail;
    #[Validate(['images.*' => 'image|max:10240'])]
    public $images = [];
    public $newImages = [];
    public $temporaryImages = [];

    public $owners = [];
    public $categories = [];
    public $subCategories = [];
    public $microchipped_status;
    public $neutered_status;
    public $vaccinations_status;
    public $worm_status;
    public $health_checked;
    public $special_medical_care;
    public $registered;
    public $website_link;
    public $personality;
    public $weight;
    public $colour;
    public $dob;
    public $pet_listing_type;
    public $charity_name;
    public $specific_activities;
    public $iscomportable_other_pet_cat;
    public $iscomportable_other_pet_cat_details;
    public $iscomportable_others_pets;
    public $dedicated_time;
    protected $rules = [

        // 'ad_type' => 'required',
        'category_id' => 'required',
        'uk_state_id' => 'required',
        'sub_category_id' => 'required',
        'name' => 'required|min:3',
        'gender' => 'required|in:Male,Female,Unknown',
        'age' => 'required',
        'size' => 'required',
        'colour' => 'required',
        'description' => 'required',
        'weight' => 'nullable|numeric',
        'price' => 'required|numeric|min:10|max:600',
        'personality' => 'required',
        'iscomportable_other_pet' => 'required',
        'iscomportable_other_pet_cat' => 'required',
        'iscomportable_others_pets' => 'required',
        'iscomportable_children' => 'required',
        'dedicated_time' => 'required',
        'best_fit_for_home' => 'required',
        'need_outdoor_space' => 'required',
        'images' => 'required|array|min:1',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        // old
        // 'newImages.*' => 'image|max:10240',
        //  'newImages' => 'required|array|min:1',
        // 'newImages.*' => 'image|max:10240',
        // 'newImages' => 'required',
        // 'newImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        // 'newImages' => 'required|array|min:1',
        // 'newImages.*' => 'file|image|mimes:jpeg,png,jpg,gif,webp|max:10240',


    ];

    public function messages()
    {
        return [
            'price.min' => 'Minimum adoption fee is £10.',
            'price.numeric' => 'The adoption fee must be a number.',
            'price.required' => 'The adoption fee is required.',
            'images.max' => 'Maximum Image upload size is 10 mb.',
            'iscomportable_other_pet.required' => 'is your pet comfortable around other dogs field is required.',
            'iscomportable_other_pet_cat.required' => 'is your pet comfortable around other cats field is required.',
            'iscomportable_others_pets.required' => 'is your pet comfortable around other pets field is required.',
            'iscomportable_children.required' => 'Is your pet comfortable around children field is required.',
            'dedicated_time.required' => 'How much time does your pet typically require field is required.',
            'uk_state_id.required' => 'Location field is required',
            'category_id.required' => 'The Category field is required',
            'images.required' => 'The Image field is required',

            'images.*.image' => 'Each uploaded file must be an image.',
            'images.*.mimes' => 'Images must be of type: jpeg, png, jpg, or gif.',
            'images.*.max' => 'Each image must not exceed 10MB.',
        ];
    }



    public function mount()
    {

        $this->categories = Category::where('status', 1)->get(['id', 'name']);
        $this->states = UkState::orderBy('state', 'ASC')->get(['id', 'state']);
    }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get();
        $this->sub_category_id = '';
    }


    //      public function updatedImages()
    // {
    //     foreach ($this->images as $image) {
    //         $this->temporaryImages[] = $image->temporaryUrl();
    //     }
    // }

    public function updatedNewImages()
    {
        \Log::info('NewImages updated: ', [
            'count' => is_array($this->newImages) ? count($this->newImages) : 'Not an array',
            'files' => $this->newImages,
        ]);
        foreach ($this->newImages as $file) {
            $this->images[] = $file;
        }

        // Reset newImages so user can select same files again if needed
        $this->reset('newImages');
    }


    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images); // re-index
    }
    // public function removeImage($index)
    // {
    //     unset($this->images[$index]);
    //     unset($this->temporaryImages[$index]);
    //     $this->images = array_values($this->images);
    //     $this->temporaryImages = array_values($this->temporaryImages);
    // }


    public function save()
    {
        $this->validate();

        // Create the pet record first (lightweight operation)
        $store = Pet::create([
            'owner_id' => Auth::id(),
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
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
            'ad_type' => 'Rehome a Pet',
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
            'sports' => $this->sports,
            'weight' => $this->weight,
            'colour' => $this->colour,
            'dob' => $this->dob,
            'pet_listing_type' => 'For Adopt',
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
            'iscomportable_other_pet_cat_details' => $this->iscomportable_other_pet_cat_details,
            'iscomportable_others_pets' => $this->iscomportable_others_pets,
            'dedicated_time' => $this->dedicated_time,
        ]);

        $randomNo = Str::random(6);
        $store->update([
            'advert_id' => $randomNo . $store->id,
        ]);

        if (!empty($this->images)) {
            $imageData = [];

            foreach ($this->images as $img) {
                $tempPath = $img->store('', 'livewire-tmp');
                $imageData[] = ['temp_path' => $tempPath];
            }
            // Dispatch job to process images
            ProcessPetImagesJob::dispatch($store->id, $imageData);
        }

        // Dispatch job to send emails
        SendPetListingEmailsJob::dispatch($store->id, $this->name, Auth::user());

        // Show success message and redirect immediately
        session()->flash('message', 'Pet listing created successfully! Images are being processed and emails will be sent shortly.');
        $this->reset();
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
        return view('livewire.add-pet-listing');
    }
}
