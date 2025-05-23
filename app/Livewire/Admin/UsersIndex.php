<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        //paginar registros
        $users = User::where('name','LIKE', '%' . $this->search . '%')
            ->orWhere('email','LIKE', '%' . $this->search . '%')
            ->paginate(15);
        //compact pasa users a la vista para poder renderizar los datos
        return view('livewire.admin.users-index', compact('users'));
    }
}
