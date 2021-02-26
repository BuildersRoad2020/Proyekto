<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contractors;
use App\Models\Technicians;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\ContractorDetails;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Contractor extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $status; //toggle contractor status
    public $q; //searchbox

    public $confirmingContractorDeletion = false;

    protected $queryString = [  //to show query in url
        'status',
        'q'
    ];

    public function render(Contractors $ContractorDetails )
    {
        $this->authorize('admin', App\Models\Users::class);
        $contractors = Contractors::orderby('name')->with('ContractorDetails')
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->q . '%');
                });
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->paginate(10);
           //->paginate(8);
           //dd($contractors);
        return view('livewire.contractor', [
            'contractors' => $contractors,
        ]);

   
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function confirmContractorDeletion($id)
    {
      
        $this->confirmingContractorDeletion = $id;
        // $id->ContractorDetails()->delete();
        // $id->delete();
    }

    public function DeleteContractor(Contractors $id)
    {
        $RoleUser = RoleUser::where('id', $id->role_user_id)->first();
       // dd($RoleUser);
        $User = User::where('id', $RoleUser->user_id)->first();
        $Technician = $id->Technicians()->count();
        if ($Technician != null) {
            $id->Technicians()->delete();
        }
        $id->ContractorDetails()->delete();
        $id->ContractorSkills()->delete();
        $id->delete();
        $RoleUser->delete();
        $User->delete();
        $this->confirmingContractorDeletion = false;
        session()->flash('message', 'Contractor has been removed');
    }
}
