<?php

namespace App\Livewire\Media;

use App\Models\Media;
use Livewire\Component;
use Carbon\CarbonInterval;

class MediaView extends Component
{
    ///////////////////////////// MODULO VARIABLES /////////////////////////////
    public $media;

    public function mount($uuid){
        $this->media = Media::where('uuid', $uuid)->with('media_tags')->first();
    }

    public function render()
    {
        $type_content = Media::typeContent();
        $status_media = Media::statusMedia();
        $valoration_stars = Media::valorationStars();
        $format = Media::format();
        $emission_status = Media::emission_status();

        $duration_hs = CarbonInterval::minutes($this->media->duration)->cascade();

        return view('livewire.media.media-view', compact(
            'status_media',
            'valoration_stars',
            'type_content',
            'duration_hs',
            'format',
            'emission_status',
        ));
    }
}
