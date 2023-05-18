<?php

namespace App\Http\Livewire;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $photos = [];

    protected function rules()
    {
        return ['photos.*' => 'image|max:1024'];
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function reorder($orderedIds)
    {

    }

    public function save()
    {
        $photos = $this->validate();

        dd($photos);

        foreach ($this->photos as $photo) {
            $uploaded = $photo->store('public');
        }
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}
