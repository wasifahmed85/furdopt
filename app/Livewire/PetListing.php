<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Pet;
use App\Models\PetImage;
use App\Models\PetSoptlight;
use App\Models\SubCategory;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;

class PetListing extends Component
{
    use WithPagination;
    #[Title(' Pet Listing')]
    public $errors;
    public $selectPetid;

    public function selecData($id)

    {

        $this->selectPetid = $id;
    }

    public function addToSpotLight($id)
    {
        $check = Auth::user();
        if ($check->spotlight > 0) {
            $subcriptions = Subscription::where('user_id', Auth::user()->id)->first();

            PetSoptlight::create([
                'pet_id' => $id,
                'user_id' => Auth::user()->id,
                'end_date' =>  $subcriptions->end_date,
            ]);
            Auth::user()->decrement('spotlight');
        } else {
            $this->errors = 'You do not have Spotlight';
        }
    }

    public function petDelete($id)
    {
        $pet = Pet::findorfail($id);
        if ($pet->thumbnail && File::exists(public_path('images/' . $pet->thumbnail))) {
            File::delete(public_path('images/' . $pet->thumbnail));
        }

        $oldImages = PetImage::where('pet_id', $pet->id)->get();
        if ($oldImages) {


            foreach ($oldImages as $oldImage) {
                // Storage::disk('public')->delete('images/' . $oldImage->image);
                File::delete(public_path('images/' . $oldImage->image));
                $oldImage->delete();
            }
        }

        $pet->delete();
    }

    public function promotePayment($id)
    {
        $encryptedId = Crypt::encryptString($id);
        return $this->redirect(route('f.promote.payment', ['id' => $encryptedId]), navigate: true);
    }

    public function render()
    {

        return view('livewire.pet-listing', [
            // 'pets' => Pet::with('spotlight')->where('owner_id', Auth::user()->id)->latest()->paginate(3)
            'pets' => Pet::with(['spotlight' => function ($query) {
                $query->limit(1);
            }, 'promotePayments'])->where('owner_id', Auth::user()->id)->latest()->paginate(3)
        ]);
    }
}
