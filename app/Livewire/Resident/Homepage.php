<?php

namespace App\Livewire\Resident;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.resident')]
class Homepage extends Component
{
    public function render()
    {
        return view('livewire.resident.homepage');
    }
}
