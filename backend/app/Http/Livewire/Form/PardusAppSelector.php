<?php

namespace App\Http\Livewire\Form;

use App\Models\PardusApp;
use Livewire\Component;

class PardusAppSelector extends Component
{
    public $pardusApps = [];
    public $selected = [];
    public $filteredPardusApps = [];
    public $searchWord = '';

    public function mount()
    {
        $this->pardusApps = PardusApp::all();
    }

    public function select($id)
    {
        array_push($this->selected, $id);
    }

    public function deselect($id)
    {
        foreach ($this->selected as $key => $value) {
            if ($value == $id) {
                unset($this->selected[$key]);
            }
        }
    }

    public function render()
    {
        if (isset($this->searchWord)) {
            $this->filteredPardusApps = PardusApp::where('name', 'LIKE', "%{$this->searchWord}%")->get();
        } else {
            $this->filteredPardusApps = $this->pardusApps;
        }
        return view('livewire.form.pardus-app-selector');
    }
}
