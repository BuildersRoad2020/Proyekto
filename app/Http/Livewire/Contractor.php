<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contractors;
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
        $this->authorize('viewany', App\Models\Contractors::class);
        $contractors = Contractors::orderby('name')->with('ContractorDetails')
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->q . '%');
                });
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->paginate();
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
       
        $id->ContractorDetails()->delete();
        $id->delete();
        $this->confirmingContractorDeletion = false;
    }
}
