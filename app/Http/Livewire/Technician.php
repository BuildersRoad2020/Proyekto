<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Contractors;
use App\Models\Technicians;
use App\Models\RoleUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Technician extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $confirmingTechnicianAdd = false;
    public $confirmingTechnicianDelete = false;

    public $name;
    public $email;
    public $contractors_id;

    public $status; //toggle contractor status
    public $q; //searchbox

    protected $queryString = [  //to show query in url
        'status',
        'q'
    ];

    public function render()
    {
        $this->authorize('adminvendor2', App\Models\Users::class);

        $users = auth()->user()->roleuser()->pluck('role_id')->toarray();
        foreach ($users as $key => $role_id) {
            if ($role_id == 2 && 1) {       //search Technicians table only assigned to this contractor
                $id = auth()->user()->roleuser()->where('role_id', 2)->pluck('id');
                $contractor = Contractors::where('role_user_id', $id)->pluck('id');
                $technicians = Technicians::where('contractors_id', $contractor)
                    ->when($this->q, function ($query) {
                        return $query->where(function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->q . '%');
                        });
                    })
                    ->when($this->status, function ($query) {
                        return $query->where('status', $this->status);
                    })->paginate(9);
            }
            if ($role_id == 2) {               //search Technicians table only assigned to this contractor
                $id = auth()->user()->roleuser()->where('role_id', 2)->pluck('id');
                $contractor = Contractors::where('role_user_id', $id)->pluck('id');
                $technicians = Technicians::where('contractors_id', $contractor)
                    ->when($this->q, function ($query) {
                        return $query->where(function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->q . '%');
                        });
                    })
                    ->when($this->status, function ($query) {
                        return $query->where('status', $this->status);
                    })->paginate(9);
            } else if ($role_id == 1) {   //Search all technicians and Contractors Table
                $technicians = Technicians::with('contractors')
                    ->when($this->q, function ($query) {
                        return $query->where(function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->q . '%')
                                ->orwherehas('contractors', function ($query) {
                                    $query->where('name', 'LIKE', '%' . $this->q . '%');
                                });
                        });
                    })
                    ->when($this->status, function ($query) {
                        return $query->where('status', $this->status);
                    })->paginate(9);
            }
        }
        $id = auth()->user()->roleuser()->where('role_id', 2)->pluck('id')->first();
        $specifiedcontractors = Contractors::where('role_user_id', $id)->first();
        //dd($specifiedcontractors);
        return view('livewire.technician', [
            'technicians' => $technicians,
            'specifiedcontractors' => $specifiedcontractors,
            'contractors' => Contractors::get(),
            'checkrole' => auth()->user()->roleuser()->firstwhere('role_id', 2),
        ]);
    }

    /* Add Technician */
    public function confirmTechnicianAdd()
    {
        $this->confirmingTechnicianAdd = true;
    }

    public function TechnicianAdd()
    {

        $validatedData = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'role_users' => auth()->user()->roleuser()->firstwhere('role_id',2),
                'contractors_id' => ['required'],
            ],
            [
                'name.required' => 'Please enter a name',
                'email.required' => 'Please enter an email address',
                'contractors_id.required' => 'Please assign tech to a Contractor'
                // 'role_id.required' => 'Please select at least one role'
            ]
        );

        $user = new User;
        $user->name = ucwords($validatedData['name']);
        $user->email = $validatedData['email'];
        $user->password = /* Hash::make($password), */ '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6';
        $user->save();
        $RoleUser = $user->RoleUser()->create(['role_id' => '3']);
        $Technician = $RoleUser->Technicians()->create([
            'contractors_id' => $validatedData['contractors_id'],
            'name' =>  $validatedData['name'],
            'role_users_id' => $RoleUser->id,
        ]);

        $this->confirmingTechnicianAdd = false;
        session()->flash('message', 'Technician has been added');
    }

        /* Delete Technician but not from Users*/
    public function confirmTechnicianDelete($id)
    {
        $this->confirmingTechnicianDelete = $id;
    }

    public function DeleteTechnician(Technicians $id)
    {
       $RoleUser = RoleUser::where('id',$id->role_users_id)->where('role_id', 3)->first();
       $deleteTechnician = $id->delete(); 
       $RoleUser->delete();
        $this->confirmingTechnicianDelete = false;
        session()->flash('message', 'Technician has been removed');
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }
}
