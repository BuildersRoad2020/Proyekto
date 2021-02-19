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
    public $abn;    
    public $name_primarycontact;
    public $phone_primary;
    public $email_primary;
    public $name_secondarycontact;
    public $phone_secondary;
    public $email_secondary;
    public $terms;
    public $currency;
    public $bankname;
    public $branch;
    public $accountname;
    public $bsb;
    public $accountnumber;
    public $status; 
    public $confirmingEdit = false;   
 /*    public Contractors $status;
    public $name; */

/*     public $rules = [
        'address' => ['required'],
        'city' => ['required'],
        'postcode' => ['required'],
        'state' => ['required'],
        'country' => ['required'],
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
        $this->postcode = $id->postcode;              
        $this->state = $id->state; 
        $this->country = $id->country; 
        $this->abn = $id->abn;         
        $this->name_primarycontact = $id->name_primarycontact; 
        $this->phone_primary = $id->phone_primary;   
        $this->email_primary = $id->email_primary;     
        $this->name_secondarycontact = $id->name_secondarycontact; 
        $this->phone_secondary = $id->phone_secondary;   
        $this->email_secondary = $id->email_secondary;       
        $this->terms = $id->terms;   
        $this->currency = $id->currency;   
        $this->bankname = $id->bankname;   
        $this->branch = $id->branch;   
        $this->accountname = $id->accountname;          
        $this->bsb = $id->bsb;     
        $this->accountnumber = $id->accountnumber;   
                                            
    }
        

    public function render()
    {
        $id =  Contractors::where('id', $this->contractors->contractors_id)->select('name', 'status')->first();
        $this->status = $id->status;

       // dd($this->name);
        return view('livewire.contractor-i-d', [
            'id' => $id,
        ]);
    } 

    public function confirmEdit(ContractorDetails $id)
    {
        $this->confirmingEdit = false;
        $validatedData = $this->validate([
            'address' => 'required|max:60',
            'city' => 'required',
            'postcode' => 'required',
            'state' => 'required',
            'country' => 'required',
            'abn' => 'required|min:10|max:20',
            'name_primarycontact' => 'required',
            'phone_primary' => ['required', 'regex:/^[0-9]+$/'],
            'terms' => 'required',
            'currency' => 'required',
            'branch' => 'required',
            'bankname' => 'required',
            'bsb' => 'required',
            'accountnumber' => 'required|numeric',
            'accountname' => 'required',
            'email_secondary' => 'nullable|email',
          ], [
            'name_primarycontact.required' => 'Please enter Primary Contact Person',
            'phone_primary.required' => 'Please enter contact number',
            'phone_primary.regex' => 'No space and only numbers',
            'address.required' => 'Street Name is required',
            'address.max' => 'Street Name maximum characters is only 60',
            'country.required' => 'Please select a Country',
            'state.required' => 'Please select a State',
            'city.required' => 'Please select a City',
            'postcode.required' => 'Post Code is required',
            'abn.required' => 'Please enter your Australian Business Number',
            'terms.required' => 'Please select Payment Terms',
            'currency.required' => 'Please select your Currency',
            'bankname.required' => 'Please enter your Bank Name',
            'branch.required' => 'Please enter your Banks Branch Name',
            'bsb.required' => 'Please enter Bank/State/Branch Number',
            'accountnumber.required' => 'Please enter your account number',
            'accountnumber.numeric' => 'Account Number must be numeric',
            'accountname.required' => 'Please enter your Account Name',    
          ]);
        
          $validatedData = ContractorDetails::find($this->contractors->id);
          $validatedData->address = ucwords($this->address);
          $validatedData->city = $this->city;
          $validatedData->postcode = $this->postcode;
          $validatedData->state = $this->state;
          $validatedData->country = $this->country;
          $validatedData->abn = $this->abn;
          $validatedData->name_primarycontact = $this->name_primarycontact;
          $validatedData->phone_primary = $this->phone_primary;
          $validatedData->email_primary = $this->email_primary;
          $validatedData->name_secondarycontact = $this->name_secondarycontact;
          $validatedData->phone_secondary = $this->phone_secondary;
          $validatedData->email_secondary = $this->email_secondary;
          $validatedData->terms = $this->terms;
          $validatedData->currency = $this->currency;
          $validatedData->bankname = $this->bankname;
          $validatedData->branch = $this->branch;
          $validatedData->accountname = $this->accountname;      
          $validatedData->bsb = $this->bsb;  
          $validatedData->accountnumber = $this->accountnumber;                                              
          $validatedData->save();

          $this->confirmingEdit = false;
    }
}
