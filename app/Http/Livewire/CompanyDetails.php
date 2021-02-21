<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Contractors;
use App\Models\ContractorDetails;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyDetails extends Component
{
    use AuthorizesRequests;
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

    public $input = false;
    public $select = false;

    public $SelectedCountry = null;
    public $SelectedState = null;
    public $SelectedCity = null;
    public $states = null;
    public $cities = null;

    public function render()
    {
        $this->authorize('adminvendor', App\Policies\Users::class);
        $user = User::where('id', auth()->user()->id)->first()->roleuser()->where('role_id', 2)->pluck('id');
        $id = Contractors::where('role_user_id', $user)->first();
        $info = ContractorDetails::where('contractors_id', $id->id)->first();
        $country = Countries::where('id', $info->country)->first();
        $state = States::where('id', $info->state)->first();
        $city = Cities::where('id', $info->city)->first();

       //isset($country->name) ? $this->input = true : $this->input = true;

        $this->address = $info->address;
        $this->city = isset($city->name) ? $city->name : '';
        $this->postcode = $info->postcode;
        $this->state = isset($state->name) ? $state->name : '';
        $this->country = isset($country->name) ? $country->name : '';
        $this->abn = $info->abn;
        $this->name_primarycontact = $info->name_primarycontact;
        $this->phone_primary = $info->phone_primary;
        $this->email_primary = $info->email_primary;
        $this->name_secondarycontact = $info->name_secondarycontact;
        $this->phone_secondary = $info->phone_secondary;
        $this->email_secondary = $info->email_secondary;
        $this->terms = $info->terms;
        $this->currency = $info->currency;
        $this->bankname = $info->bankname;
        $this->branch = $info->branch;
        $this->accountname = $info->accountname;
        $this->bsb = $info->bsb;
        $this->accountnumber = $info->accountnumber;
 
        return view('livewire.company-details', [
            'id' => $id,
            'countries' => Countries::all(),
            'info' => $info
        ]);
    }

    public function updatedSelectedCountry($countries_id) {
        $this->states = States::where('countries_id', $countries_id)->get();
    }

    public function updatedSelectedState($states_id) {
        $this->cities = Cities::where('states_id', $states_id)->get();
    }

    // to update record
    public function confirmEdit()
    {
        $this->authorize('adminvendor', App\Policies\Users::class);
        $user = User::where('id', auth()->user()->id)->first()->roleuser()->where('role_id', 2)->pluck('id');
        $id = Contractors::where('role_user_id', $user)->first();
        $info = ContractorDetails::where('contractors_id', $id->id)->first();

        $validatedData = $this->validate(
            [
                'address' => 'required|max:60',
               // 'city' => 'required',
                'postcode' => 'required',
               // 'country' => 'nullable',
               // 'state' => 'nullable',
               'SelectedCity' => 'required_if:city,',
                'SelectedState' => 'required_if:state,',
                'SelectedCountry' => 'required_if:country,',
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
            ],
            [
                'name_primarycontact.required' => 'Please enter Primary Contact Person',
                'phone_primary.required' => 'Please enter contact number',
                'phone_primary.regex' => 'No space and only numbers',
                'address.required' => 'Street Name is required',
                'address.max' => 'Street Name maximum characters is only 60',
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
            ]
        );
        $validatedData = ContractorDetails::find($info->id);
        $validatedData->address = ucwords($this->address);
      //  $validatedData->city = $this->city;
        $validatedData->postcode = $this->postcode;
        $validatedData->city = isset($this->city) ? $this->SelectedCity : $this->city;        
        $validatedData->state = isset($this->state) ? $this->SelectedState : $this->state;
        $validatedData->country = isset($this->country) ? $this->SelectedCountry : $this->country;
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
        session()->flash('message', 'Contractor has been updated');
       // return redirect()->to('/contractor/companydetails');
        
    }
}
