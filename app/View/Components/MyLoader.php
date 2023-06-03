<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyLoader extends Component
{
    /**
     * The message to display in the loader.
     *
     * @var string
     */
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message = 'Loading...')
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.my-loader');
    }
}
