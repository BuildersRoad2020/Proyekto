<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contractors;
use App\Models\Skills;
use App\Models\ContractorSkills as MySkill;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContractorSkills extends Component
{
    use AuthorizesRequests;

    public $skills_id;
    public $confirm = false;

    public function render()
    {
        $this->authorize('adminvendor2', App\Policies\Users::class);
        $user = User::where('id', auth()->user()->id)->first()->roleuser()->where('role_id', 2)->pluck('id');
        $id = Contractors::where('role_user_id', $user)->first();
        $skills = MySkill::where('contractors_id', $id->id)->with('skills')->get();

     //  dd($skills);

        return view('livewire.contractor-skills',[
            'lists' => Skills::all(),
            'skills' => $skills,
        ]);
    }

    public function AddSkill() {

        $this->authorize('adminvendor', App\Policies\Users::class);
        $validatedData = $this->validate(
            [
                'skills_id' => 'required',
            ],
            [
                'skills_id.required' => 'Please select a skill',
            ]
        );
        $user = User::where('id', auth()->user()->id)->first()->roleuser()->where('role_id', 2)->pluck('id');
        $id = Contractors::where('role_user_id', $user)->first();

        $add = MySkill::firstOrCreate(
            ['contractors_id' => $id->id, 'skills_id' => $validatedData['skills_id']],
            ['skills_id' => $validatedData['skills_id']]
        );
           
        session()->flash('message', 'Skill Added');
    }

    public function confirmDeleteSkill($id) {
      //  dd($id);
        $this->confirm = $id;
    }

    public function DeleteSkill(MySkill $id) {

        $id->delete();
        $this->confirm = false;
        session()->flash('message', 'Skill removed'); 
        //dd($contractor);
    }
}
