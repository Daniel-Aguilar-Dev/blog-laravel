<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class Navegation extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.navegation', compact('categories'));
    }
}
