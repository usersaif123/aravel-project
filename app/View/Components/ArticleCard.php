<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $titre;
    public $auteur;
    public $contenu;
    public function __construct($titre, $auteur, $contenu)
    {
        $this-> titre = $titre;
        $this-> auteur = $auteur;
        $this-> contenu = $contenu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-card');
    }
}
