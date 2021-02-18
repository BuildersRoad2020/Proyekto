<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contractors;
use App\Models\ContractorDetails;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContractorID extends Component
{

    use AuthorizesRequests;

    public ContractorDetails $contractors;
    public $address;
    public $city;
    public $postcode;
    public $state;
    public $country;
    public $name_primarycontact;
    public $phone_primary;
    public $email_primary;
    public $name_secondarycontact;
    public $phone_secondary;
    public $email_secondary;

/*     public $rules = [
        'address' => ['required'],
        'city' => ['required'],
        'postcode' => ['required'],
        'state' => ['required'],
        'country' => ['required'],
        'abn' => ['required'],
        'abn' => ['required'],
        'name_primarycontact' => ['required'],
        'phone_primary' => ['required'],
        'email_primary' => ['required'],
        'name_secondarycontact' => ['required'],
        'phone_secondary' => ['required'],
        'email_secondary' => ['required'],
        'terms' => ['required'],
        'currency' => ['required'],
        'bankname' => ['required'],
        'branch' => ['required'],
        'accountname' => ['required'],
        'bsb' => ['required'],
        'accountnumber' => ['required']
    ]; */

    public function mount(ContractorDetails $id)
    {
        $this->authorize('viewany', App\Models\Contractors::class);
        $this->contractors = $id;
        $this->address = $id->address;
        $this->city = $id->city;      
        $this->state = $id->state; 
        $this->country = $id->country; 
        $this->name_primarycontact = $id->name_primarycontact; 
        $this->phone_primary = $id->phone_primary;   
        $this->email_primary = $id->email_primary;     
        $this->name_secondarycontact = $id->name_secondarycontact; 
        $this->phone_secondary = $id->phone_secondary;   
        $this->email_secondary = $id->email_secondary;         
    }
        


    public function render()
    {
        $status =  Contractors::where('id', $this->contractors->contractors_id)->select('name', 'status')->first();
        return view('livewire.contractor-i-d', [
            'status' => $status,
        ]);
    }

    public function confirmEdit(ContractorDetails $id)
    {
       //
    }
}
