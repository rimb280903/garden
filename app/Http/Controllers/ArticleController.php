<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Article;

class ArticleController extends Controller
{
    // Méthode pour afficher le formulaire d'ajout d'un nouvel article
    public function index()
    {
        return view('apparence.article');
    }
    public function index2(Request $request)
    {
        // Récupérer le mot-clé de recherche depuis la requête
        $keyword = $request->input('q');

        // Récupérer tous les articles ou effectuer la recherche
        $articles = Article::query();

        if ($keyword) {
            $articles->where('title', 'like', "%$keyword%")
                    ->orWhere('content', 'like', "%$keyword%");
        }

        $articles = $articles->paginate(10); // Paginer les résultats de la recherche

        // Retourner la vue avec les articles et le mot-clé de recherche
        return view('admin.article.list', compact('articles', 'keyword'));
    }

    public function derniers()
    {
        // Récupérer les trois derniers articles ajoutés
        $articles = Article::latest()->take(3)->get();

        // Retourner la vue avec les articles
        return view('apparence.index')->with('articles', $articles);;
    }

    public function showarticle($id)
{
    $article = Article::findOrFail($id);
    return view('apparence.article', compact('article'));
}
public function showArticles()
{
    $articles = Article::all();
    return view('apparence.articles', compact('articles'));
}






    // Méthode pour enregistrer un nouvel article dans la base de données
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valider l'image
        ]);

        // Enregistrer l'image dans le stockage
        $imagePath = $request->file('image')->store('images');

        // Créer un nouvel article
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->image = $imagePath; // Sauvegarder le chemin de l'image dans la base de données
        $article->save();

        // Rediriger avec un message de succès
        return redirect()->route('admin.blogs')->with('success', 'Article ajouté avec succès!');
    }
    public function create()
    {
        return view('admin.article.add');
    }
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.article.edit', compact('article'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.blogs')->with('success', 'Article mis à jour avec succès!');
    }
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.blogs')->with('success', 'Article supprimé avec succès!');
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.article.show', compact('article'));
    }
}
