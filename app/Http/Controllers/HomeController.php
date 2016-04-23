<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Publication;
use App\Categorie;
use App\Organisation;
use App\Auteur;
use App\User;
use App\Http\Controllers\AuteurController;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'auteurs_perf' => Auteur::byPerformance(),
            'publications' => Publication::all(),
            'publications_ext' => Publication::noAuteurUTT(),
            'doublons' => Publication::doublons(),
            'doublons_auteurs' => Publication::doublons_auteurs(),
            'comptes' => User::all(),
            'auteurs_doublons' => Auteur::doublons(),
        ]);
    }

    public function profile()
    {
        return view('auteur.show', [
            'auteur' => \Auth::user()->auteur,
            'coauteurs' => \Auth::user()->auteur->coauteurs(),
            'firstPub' => \Auth::user()->auteur->firstPublicationYear(),
            'lastPub' => \Auth::user()->auteur->lastPublicationYear(),
        ]);
    }

    public function welcome()
    {
        $categories = Categorie::all();
        $organisation = Organisation::UTT();
        $publications = Publication::orderBy('annee', 'desc')->limit(3)->get();

        return view('welcome', [
            'categories' => $categories,
            'organisation' => $organisation[0],
            'publications' => $publications,
        ]);
    }
}
