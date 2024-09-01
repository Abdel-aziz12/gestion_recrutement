<?php

namespace App\Http\Controllers;

use App\Http\Requests\createCategoryRequest;
use App\Models\Category;
use App\Models\Interview;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Récupère la date et l'heure d'aujourd'hui
        //  $today = now()->toDateString();

        //  // Récupère tous les entretiens pour aujourd'hui avec leurs relations
        //  $entretiens = Interview::with(['candidatures.category'])
        //      ->whereDate('date', $today)
        //      ->get();

        //  // Compte le nombre d'entretiens pour aujourd'hui
        //  $count = $entretiens->count();

        $categories = Category::with('candidatures')->orderBy('id', 'desc')->paginate(2);
        return view('admin.categorie.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            // Création du code à partir des premières lettres du nom
            $code = strtoupper(substr($request->nom, 0, 3).rand(100, 999));

            // Création de la catégorie
            $category = Category::create([
                'nom' => $request->nom,
                'code' => $code,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()->route('categories.index')->with('success', 'La catégorie a été insérée avec succès.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $categories = Category::findOrFail($id);
            return view('admin.categorie.edit', compact('categories'));
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id)
    {

        try {
            // Récupérer la catégorie que vous souhaitez mettre à jour
            $categories = Category::findOrFail($id);

            // Créer le code à partir des premières lettres du nom
            $code = strtoupper(substr($request->input('nom'), 0, 3));
            $nom = ucfirst($request->input('nom'));

            // Création de la catégorie
            $categories->update([
                'nom' => $nom,
                'code' => $code,
                'user_id' => auth()->user()->id,
            ]);
            // Définir un message de succès et rediriger
            session()->flash('success', 'La catégorie a été modifiée avec succès.');
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function desactivate($id)
    {
        $category = Category::find($id);
        if ($category) {
            // Inverser la valeur de is_active
            $category->is_active = !$category->is_active;
            $category->save();
        }
        return redirect()->route('categorie.index')->with('success', 'Statut de la catégorie mis à jour avec succès.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $categorie = Category::findOrFail($id);

            $categorie->delete();

            session()->flash('success', 'La catégorie a été supprimé avec succès..');
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function search(Request $request)
    {
        // Récupérer la valeur de recherche depuis la requête
        $search = $request->input('search');
        // Effectuer la recherche sur les colonnes 'name', 'code' et 'statut'
        $categories = Category::where(function ($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%")
                ->orWhere('is_active', 'like', "%$search%");
        })->paginate(2);

        // Retourner la vue avec les résultats de recherche
        return view('admin.categorie.index', compact('categories', 'search'));
    }
}
