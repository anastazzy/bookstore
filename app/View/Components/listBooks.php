<?php

namespace App\View\Components;

use Illuminate\View\Component;

class listBooks extends Component
{
    public $books;
    public function __construct($books)
    {
        $this->books = $books;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-books');
    }
}
