@foreach($articles as $article)
<x-article-card :titre="$article['titre']"
:auteur="$article['auteur']"
:contenu="$article['contenu']">
{{$article['contenu']}}

</x-article-card>


@endforeach

<x-alert type="success">
    Article Ajouté avec succés
</x-alert>

<x-alert type="danger">
    Article Ajouté avec succés
</x-alert>

<x-alert type="info">
    Article Ajouté avec succés
</x-alert>


