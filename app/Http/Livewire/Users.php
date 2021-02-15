<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Roles;
use Livewire\WithPagination;

class Users extends Component
{

    use WithPagination;
    public $q; //searchbox

    protected $queryString = [  //to show query in url
        'q'
    ];
    public function render()
    {
        $users = User::with('RoleUser')->orderby('name')
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->q . '%');
            });
        }) 
        ->paginate(8);

        return view('livewire.users', [
            'users' => $users,
        ]);
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

}
