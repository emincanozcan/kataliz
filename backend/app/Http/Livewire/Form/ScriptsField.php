<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class ScriptsField extends Component
{
    public $scripts = [];

    public function addNew()
    {
        array_push($this->scripts, "");
    }

    public function remove($key)
    {
        unset($this->scripts[$key]);

    }

    public function render()
    {
        return view('livewire.form.scripts-field');
    }
}
