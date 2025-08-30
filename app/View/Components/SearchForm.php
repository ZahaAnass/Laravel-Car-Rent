<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * Create a new component instance.
     */
    public string $action;
    public string $method;

    public function __construct(string $action = '/search', string $method = 'GET')
    {
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-form');
    }

    /*
        * Do not use these public properties or methods.
        * - data
        * - render
        * - resolveView
        * - shouldRender
        * - view
        * - withAttributes
        * - withName
    */


    public function test()
    {
        return "Somthing";
    }
}
