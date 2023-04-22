<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{
    //se crea la propiedad que viene en la vista en elc omponente
    public $posts;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    //cojemos la variable del componente que viene de la vista y la asignamos a la variable public como un setter
    public function __construct($posts)
    {
        //
        $this->posts=$posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
