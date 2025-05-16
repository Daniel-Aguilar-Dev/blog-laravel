<?php

namespace App\Livewire;

use Livewire\Component;

class TestSearch extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.test-search');
    }
}
