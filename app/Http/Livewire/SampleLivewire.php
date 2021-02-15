<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SampleLivewire extends Component
{
    public $count = 12;

    public function render()
    {
        return view('livewire.sample-livewire');
    }

    public function plus()
    {
        $this->count++;
    }
}
