<?php

namespace App\Jobs;

use App\Models\Pet;
use App\Models\PetImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Log;

class ProcessPetImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $petId;
    protected $imageData;

    public function __construct($petId, $imageData)
    {
        $this->petId = $petId;
        // Ensure imageData is an array of associative arrays
        $this->imageData = $imageData;
    }

    public function handle()
    {
        $pet = Pet::find($this->petId);
        if (!$pet) {
            Log::error("Pet not found for ID: {$this->petId}");
            return;
        }

        $manager = new ImageManager(new Driver());
        $firstImage = true;

        // CORRECT LOGGING FOR ARRAY
        Log::info('Images in Job:', ['imageData' => $this->imageData]);

        foreach ($this->imageData as $imageInfo) {
            try {
                // Diagnostic log to confirm the structure of $imageInfo within the loop
                \Log::info('Processing image from imageData:', $imageInfo);

                // Ensure $imageInfo['temp_path'] exists and is a string
                if (!isset($imageInfo['temp_path']) || !is_string($imageInfo['temp_path'])) {
                    \Log::warning('Missing or invalid "temp_path" in imageInfo:', ['imageInfo' => $imageInfo]);
                    continue;
                }

                $tempFilePath = $imageInfo['temp_path'];
                $tempFileContent = Storage::disk('livewire-tmp')->get($tempFilePath);

                // Re-adding the detailed check for file content
                \Log::info('Checking image content before processing:', [
                    'temp_path' => $tempFilePath,
                    'content_is_null_or_empty' => is_null($tempFileContent) || empty($tempFileContent),
                    'content_type' => gettype($tempFileContent),
                    'content_length' => is_string($tempFileContent) ? strlen($tempFileContent) : 'N/A'
                ]);

                if (!$tempFileContent) {
                    \Log::warning('Temporary image file not found or empty: ' . $tempFilePath);
                    // IMPORTANT: Delete the temporary file if it's not found or empty to prevent retries on bad files
                    Storage::disk('livewire-tmp')->delete($tempFilePath);
                    continue;
                }

                $imageName = uniqid() . '.webp'; // Prepare the final image name with .webp extension

                // Process image from the content and save it directly
                $image = $manager->read($tempFileContent);
                $image->toWebp(100)->save(public_path('images/' . $imageName)); // Corrected method to save

                // Set first image as thumbnail
                if ($firstImage && !$pet->thumbnail) {
                    $pet->update(['thumbnail' => $imageName]);
                    $firstImage = false;
                }
                // CORRECTED: Log array as second argument
                Log::info('Pet updated: ', $pet->refresh()->toArray());

                // Create pet image record
                $petImage = PetImage::create([
                    'pet_id' => $pet->id,
                    'image' => $imageName
                ]);
                // CORRECTED: Log array as second argument
                Log::info('Pet image created:', $petImage->toArray()); // This is line 86 in your provided code

                // Clean up temporary file from Livewire's temporary disk
                Storage::disk('livewire-tmp')->delete($tempFilePath);

            } catch (\Exception $e) {
                // Log error but continue processing other images
                \Log::error('Failed to process pet image: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            }
        }
    }

    public function failed(\Throwable $exception)
    {
        // Clean up temporary files on failure from Livewire's temporary disk
        foreach ($this->imageData as $imageInfo) {
            if (isset($imageInfo['temp_path'])) {
                Storage::disk('livewire-tmp')->delete($imageInfo['temp_path']);
            }
        }
        \Log::error('ProcessPetImagesJob failed: ' . $exception->getMessage());
    }
}

