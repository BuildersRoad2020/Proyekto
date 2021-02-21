<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Contractors;
use App\Models\ContractorDetails;
use App\Models\RoleUser;
use App\Models\Roles;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
                'role_id' => ['required']
            ],
            [
                'name.required' => 'Please enter a name',
                'email.required' => 'Please enter an email address',
                'role_id.required' => 'Please select at least one role'
            ]
        );
        auth()->user()->create([
            'name' => ucwords($validatedData['name']),
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
        ]);
        //Add a role
        foreach ($validatedData['role_id'] as $key => $value) {
            RoleUser::create([
                'role_id' => $value,
                'user_id' => User::latest()->pluck('id')->first(),
            ]);
            //if role is Contractor, creates contractor and contractor details
            if ($value == 2) {
                Contractors::create([
                    'role_user_id' => RoleUser::where('role_id',2)->latest()->pluck('id')->first(),
                    'name' => ucwords($validatedData['name'])
                ]);
                ContractorDetails::create([
                    'contractors_id' => Contractors::latest()->pluck('id')->first(),
                    'email_primary'=> $this->email
                ]);
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
        //to delete from ContractorDetails Table
        $Contractor = $id->Contractors()->pluck('role_user_id')->first();
        //dd($Contractor);
        if ($Contractor != null) {
        $Contractordetails = Contractors::where('role_user_id', $Contractor)->pluck('id');
        $find = ContractorDetails::where('contractors_id', $Contractordetails);    
        $find->delete();
        $id->Contractors()->delete();       //to Delete from Contractors Table
        }
  
        $id->RoleUser()->delete(); // to Delete from Role_Users Table
        $id->delete(); // to Delete User
        $this->confirmingUserDelete = false;
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
