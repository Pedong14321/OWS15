<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Admin;

class MyFirstLivewire extends Component
{
    // storer of the data fetched from mount()
    public $admins;

    // mounting data
    public function mount()
    {
        $this->admins = Admin::all();
    }

    // renderer of the view
    public function render()
    {
        return view('livewire.my-first-livewire');
    }

    // fetching dynamic data
    public function poll()
    {
        // Fetch the updated data from the database
        $this->admins = Admin::all();
    }
}
