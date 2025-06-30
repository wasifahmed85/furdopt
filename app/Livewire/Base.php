<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class Base extends Component
{
    use WithFileUploads;
    #[Title(' Base')]

    public $religion;
     #[Validate('max:200')]
    public $bio;
    public $username;
    public $gender;
    public $height;
    public $weight;
    public $avatar;
    public $profileImage;
    public $rehome_centre_p;
    public $rehome_centre_pic;



    public function mount()
    {
        $user = Auth::user();
        $detail = UserDetail::where('user_id', $user->id)->first();
        if($detail)
        {
            $this->religion = $detail->religion;
            $this->bio = $detail->bio;
            $this->username = $user->name;
            $this->gender = $user->gender;
            $this->height = $detail->height;
            $this->weight = $detail->weight;
            $this->profileImage = $user->avatar;
            $this->rehome_centre_p = $detail->rehome_centre_p;
        }


    }

    public function updateData()
    {
        Auth::user()->update([
            'name' => $this->username,
            'gender' => $this->gender,

        ]);
        $manager = new ImageManager(new Driver());
        if ($this->avatar) {
            $thumbnailName = uniqid() . '.webp';
            $image = $manager->read($this->avatar->getRealPath())
                ->cover(300, 300)
                ->toWebp(90);

            // Storage::disk('public')->put('images/' . $thumbnailName, (string) $image);
            $imagePath = public_path('images/' . $thumbnailName);
            if (!File::exists(public_path('images'))) {
                File::makeDirectory(public_path('images'), 0777, true, true);
            }
            file_put_contents($imagePath, (string) $image);

            Auth::user()->update([
                'avatar' => $thumbnailName
            ]);
        }
        
      
        
        

        UserDetail::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [

                // 'gender' => $this->gender,
                'height' => $this->height,
                'weight' => $this->weight,
                'religion' => $this->religion,
                'bio' => $this->bio,



            ]
        );
        
        
          if ($this->rehome_centre_pic) {
            
             $manager = new ImageManager(new Driver());
            $thumbnailName1 = uniqid() . '.webp';
            $image1 = $manager->read($this->rehome_centre_pic->getRealPath())
                ->cover(300, 300)
                ->toWebp(90);

            // Storage::disk('public')->put('images/' . $thumbnailName, (string) $image);
            $imagePath1 = public_path('images/' . $thumbnailName1);
            if (!File::exists(public_path('images'))) {
                File::makeDirectory(public_path('images'), 0777, true, true);
            }
            file_put_contents($imagePath1, (string) $image1);

             UserDetail::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [

               'rehome_centre_p' => $thumbnailName1


            ]
        );
        }
        


    return $this->redirect('/setting/base');

    }

    public function render()
    {
        return view('livewire.base');
    }
}
