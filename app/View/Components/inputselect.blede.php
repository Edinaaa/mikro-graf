<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputselect extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $text;
    public $id;
    public $label;
    public $value;
    
    public function __construct($type, $text, $id,  $label, $value)
    {

        $this->type = $type;
        $this->text = $text;
        $this->id= $id;
        $this->label = $label;
        $this->value = $value;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputselect');
    }
}
