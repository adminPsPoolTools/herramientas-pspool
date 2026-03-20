<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{

    public $title;
    public $description;
    public $background;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $background)
    {
        $this->title = $title;
        $this->description = $description;
        $this->background = $background;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
