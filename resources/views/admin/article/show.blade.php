@extends('admin.layouts.app')

@section('content')
<style>
    .img-reduite {
    width: 300px; /* Définissez la largeur souhaitée */
    height: auto; /* Permet de conserver le ratio d'aspect */
}

</style>
    <div class="container">
        <h1>Détails de l'article</h1>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $article->title }}</h2>
                <p class="card-text">{{ $article->content }}</p>
                <img src="{{ asset('storage/app/' . $article->image) }}" class="img-reduite" alt="Image de l'article">
            </div>
        </div>
    </div>
@endsection
