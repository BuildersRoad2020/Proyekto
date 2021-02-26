<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Contractors;
use App\Models\ContractorDetails;
use App\Models\ContractorSkills;
use App\Models\RoleUser;
use App\Models\Roles;
use App\Models\Technicians;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\Rule;

class Users extends Component
{

    use WithPagination;
    use AuthorizesRequests;
    public $q; //searchbox
    public $name;
    public $email;
    public $role_id;

    public $confirmingUserAdd = false;
    public $confirmingUserEdit = false;
    public $confirmingUserDelete = false;

    protected $queryString = [  //to show query in url
        'q'
    ];

    public function render()
    {
        $this->authorize('admin', App\Models\Users::class);
        $users = User::with('RoleUser')->orderby('name')
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->q . '%');
                });
            })
            ->paginate(10);
        return view('livewire.users', [
            'users' => $users,
        ]);
    }

    public function updatingQ()
    {
        $this->resetPage();    //Search box to reset page
    }

    //Add Function
    public function confirmUserAdd()
    {
        $this->confirmingUserAdd = true; //User Add Modal
    }

    public function UserAdd()
    {

        $password =  STR::random(10);
        $validatedData = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role_id' => ['required', function ($attribute, $value, $fail){
                    if ($value == array(1,3)) {
                        $fail('Cannot add Technician Role without a contractor');
                    }
                    else if ($value == array(3)) {
                        $fail('Cannot add Technician Role without a contractor');
                    }
                }]
            ],
            [
                'name.required' => 'Please enter a name',
                'email.required' => 'Please enter an email address',
                'role_id.required' => 'Please select at least one role'
            ]
        );

 /*        if ($this->role_id == $invalid2) {
            $this->confirmingUserAdd = false;
            session()->flash('error', 'Cannot add tech without a vendor');
        }

        if ($this->role_id == $invalid) {
            $this->confirmingUserAdd = false;
            session()->flash('error', 'Cannot add tech');
        } */


        $user = new User;
        $user->name = ucwords($validatedData['name']);
        $user->email = $validatedData['email'];
        $user->password = /* Hash::make($password), */ '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6';
        $user->save();

        foreach ($validatedData['role_id'] as $key => $value) {

            switch ($value) {
                case 1:  //admin only
                    // dd('1');
                    $role = RoleUser::create([
                        'role_id' => '1',
                        'user_id' => $user->id
                    ]);
                    break;

                case 2: //contractor
                    // dd('2');
                    $role = RoleUser::create([
                        'role_id' => '2',
                        'user_id' => $user->id
                    ]);
                    $contractor = Contractors::create([
                        'role_user_id' =>  $role->id,
                        'name' => $user->name,
                    ]);

                    $contractordetails = ContractorDetails::create([
                        'contractors_id' => $contractor->id,
                        'name' => $user->name,
                    ]);
                    break;
                case 3: //user and assigned to last created contractor
                    // dd('3');
                    $roletechnician = RoleUser::create([
                        'role_id' => '3',
                        'user_id' => $user->id
                    ]);

                    $technician = Technicians::create([
                        'contractors_id' => $id = Contractors::latest()->pluck('id')->first(),
                        'role_users_id' => $roletechnician->id,
                        'name' => $user->name,
                    ]);
                    break;
            }
        }
        $this->confirmingUserAdd = false;
        session()->flash('message', 'User has been added');
    }

    //Delete Function
    public function confirmUserDelete($id)
    {
        $this->confirmingUserDelete = $id;
    }

    public function DeleteUser(User $id)
    {
 
        $Contractor = $id->RoleUser()->where('role_id', 2)->pluck('id')->first();

        if ($Contractor !== null) {

            $Contractordetails = Contractors::where('role_user_id', $Contractor)->pluck('id');
            $find = ContractorDetails::where('contractors_id', $Contractordetails);
            $find->delete();

            $skills = ContractorSkills::where('contractors_id', $Contractordetails)->pluck('id');
            if ($skills !== null) {
                foreach ($skills as $key => $value) {
                    ContractorSkills::find($value)->delete();
                }
            }

            $Technician = Technicians::where('contractors_id', $Contractordetails)->pluck('id'); //to delete from Technicians Table
            if ($Technician !== null) {
                foreach ($Technician as $key => $value) {
                    Technicians::find($value)->delete();
                }
            }
            $query = Contractors::find($Contractordetails)->first()->delete();    //to Delete from Contractors Table
            $id->delete();
            $this->confirmingUserDelete = false;
        } else if ($Contractor === null) {
            $id->delete();
            $this->confirmingUserDelete = false;
        }

        $Technician = $id->RoleUser()->where('role_id', 3)->pluck('id')->first();

        if ($Technician !== null) {
            $find = Technicians::where('role_users_id',$Technician );
            $find->delete();
        }

        session()->flash('message', 'User has been deleted');
    }

    //Edit Function
    public function closeModal()
    {
        $this->confirmingUserEdit = false;
    }

    public function confirmUserEdit(User $id)
    {
        $this->name = $id->name;
        $this->email = $id->email;
        $this->confirmingUserEdit = $id;
    }

    public function EditUser(User $id)
    {
        $validatedData = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
            ],
            [
                'name.required' => 'Please enter a name',
                //  'role_id.required' => 'Please select at least one role'
            ]
        );
        $validatedData = User::find($id->id);
        $validatedData->name = ucwords($this->name);
        $validatedData->save();
        $this->confirmingUserEdit = false;
        $this->resetPage();
        session()->flash('message', 'User has been updated');
    }
}
