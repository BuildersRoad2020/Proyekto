<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contractors;
use App\Models\ContractorDetails;

class ContractorID extends Component
{

    public $key;

    public function mount(Contractors $key)
    {
        $this->key = $key;
/*         return view('livewire.contractor-i-d', [
            'id' => $id;
        ]); */
    }
}
