<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = [["titre" => 'titre1', "auteur" => 'Auteur 1', "contenu" => "contenu1"],
            ["titre"=>'titre2', "auteur" => 'Auteur 2', "contenu" => "contenu2"],];
        return view('index', compact('articles'));
    }
}
