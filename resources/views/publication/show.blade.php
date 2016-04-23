@extends('layouts.app')

@section('content')
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-9">
          <a href="{{ url('/publications') }}"><i class="fa fa-angle-left"></i>&nbsp;Retour aux publications</a>
          <h2>D&eacute;tail d'une publication</h2>

          <p class="clearfix"></p>

          <div class="publication publication-in">
            <h4 title="Titre de la publication">{{ $publication->titre }}</h4>
            <p class="references">
              In « {{ $publication->reference }} », <span class="date">{{ date('Y', strtotime($publication->annee)) }}</span>
              @if ($publication->lieu)
                - Conf&eacute;rence &agrave; <b>{{ $publication->lieu }}</b>
              @endif
            </p>
            <br>
            <p>
              Cat&eacute;goris&eacute; <b><a href="{{ url('/search/results/?categorie='.$publication->categorie->id) }}">{{ $publication->categorie->nom }}</a></b>.
              <br>
              Statut <b><a href="{{ url('/search/results/?statut='.$publication->statut->id) }}">{{ $publication->statut->nom }}</a></b>.
              <br>
              Ajout&eacute;e le {{ date('j/m/Y à H:i', strtotime($publication->created_at)) }}.
            </p>
            <br>
            <p>
              <a class="btn btn-theme" download="{{ $publication->document }}" href="{{ url('/upload/'.$publication->document) }}"><i class="fa fa-cloud-download"></i>&nbsp;T&eacute;l&eacute;charger<span class="hidden-xs"> le document associ&eacute;</span></a>
            </p>
          </div>

          <hr class="visible-xs visible-sm">
        </div>
        <div class="col-md-3">
          @if (Auth::user())
            <a href="{{ url('/publications/edit/'.$publication->id) }}"><i class="fa fa-angle-right"></i>&nbsp;Modifier la publication</a>
          @endif
          <h3>Auteurs</h3>
          <ul>
            @foreach ($publication->auteurs as $auteur)
              <li><a title="{{ $auteur->prenom }} {{ $auteur->nom }} - {{ $auteur->equipe->nom }}"href="{{ url('/auteurs/show/'.$auteur->id) }}">{{ $auteur->prenom }} {{ $auteur->nom }}</a></li>
            @endforeach
          </ul>
          <hr>
          <h3>&Eacute;quipes</h3>
          <ul>
            @foreach ($equipes as $equipe)
              <li><a href="{{ url('/equipes/show/'.$equipe->id) }}"><abbr title="{{ $equipe->description }}">{{ $equipe->nom }}</abbr></a></li>
            @endforeach
          </ul>
          <hr>
          <h3>Organisations</h3>
          <ul>
            @foreach ($organisations as $organisation)
              <li><a href="{{ url('/organisations/show/'.$organisation->id) }}">{{ $organisation->nom }} ({{ $organisation->etablissement }})</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('title', "Détail d'une publication")
