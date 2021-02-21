<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documents;
use App\Models\Documents_Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Document extends Component
{
    //use AuthorizesRequests;
    use WithPagination;
    public $documents__category_id;
    public $required;
    public $name;
    public $confirm = false;
    public $confirmEdit = false;
    public $confirmDelete = false;
    public $q; //searchbox

    protected $queryString = [  //to show query in url
        'q'
    ];

    public function render()
    {
        $documents = Documents::with('Documents_Category')
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->q . '%');
            });
        })
        ->paginate(10);

        return view('livewire.document', [
            'documents' => $documents,
            'categories' => Documents_Category::all()
        ]);
    }

    public function DocumentAdd() {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:60'],
            'documents__category_id' => ['required'],
            'required' => ['nullable']
        ]);
        $new = new Documents;
        $new->name = $validatedData['name'];
        $new->documents__category_id = $validatedData['documents__category_id'];
        $new->required = $validatedData['required'];
        $new->save();

        $this->confirm = false;
        session()->flash('message', 'Skills have been added');
    }
        //Edit Document
    public function confirmDocumentEdit(Documents $id) {
        $this->documents__category_id = $id->documents__category_id;
        $this->required = $id->required;
        $this->name = $id->name;     
        $this->confirmEdit = $id;
    }

    public function DocumentEdit(Documents $id) {

        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:60'],
            'documents__category_id' => ['required'],
            'required' => ['nullable']
        ]);

        $validatedData = Documents::find($id->id);

        $validatedData->name = ucwords($this->name);
        $validatedData->documents__category_id = $this->documents__category_id;
        $validatedData->required = $this->required;
        $validatedData->save();
        $this->confirmEdit = false;
        $this->documents__category_id = null;
        $this->required = null;
        $this->name = null;          
        $this->resetPage();
        session()->flash('message', 'Document has been updated');

    }

        //Delete Document
    public function confirmDocumentDelete(Documents $id) {
        $this->documents__category_id = $id->documents__category_id;
        $this->required = $id->required;
        $this->name = $id->name;     
        $this->confirmDelete = $id;
    }

    public function DocumentDelete(Documents $id) {

        $deleteData = Documents::find($id->id);
        $deleteData->delete();
        $this->confirmDelete = false;
        $this->documents__category_id = null;
        $this->required = null;
        $this->name = null;    
        $this->resetPage();
        session()->flash('message', 'Document has been deleted');

    }
}
