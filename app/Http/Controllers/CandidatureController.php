<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCandidatureRequest;
use App\Http\Requests\StoreEntretiens;
use App\Mail\ProgrammeEntretien;
use App\Models\Candidature;
use App\Models\Category;
use App\Models\Interview;
use App\Mail\SendEmailToCandidatProgrammeEntretien as MailSendEmailToCandidatProgrammeEntretien;
use Dotenv\Store\File\Paths;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve all categories for the filter options
        $categories = Category::all();

        $statut = $request->input('statut');

        $candidatures = Candidature::with('category')
            ->when($request->statut && $request->statut !== 'all', function ($q) use ($statut) {
                return $q->where('statut', $statut);
            })
            ->when($request->category_id && $request->category_id !== 'all', function ($q) use ($request) {
                return $q->where('category_id', $request->category_id);
            })
            ->orderBy('id', 'desc')->paginate(4);

        // Pass both the candidates and categories to the view
        return view('admin.candidatures.index', compact('candidatures', 'categories'));
    }

    public function showPdf($id)
    {

        // Récupérer la candidature par ID
        $candidature = Candidature::findOrFail($id);

        // Chemin du fichier PDF lié à la candidature
        $filePath = 'fichierPdf/' . $candidature->file;

        // Vérifier si le fichier PDF existe
        if (!file_exists($filePath)) {
            abort(404, 'Le fichier PDF n\'existe pas.');
        }
        // return response()->download($filePath, 'download'); pour télécharger les fichiers pdf dans un dossier
        return response()->file($filePath);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidature = Candidature::findOrFail($id);
        return view('admin.candidatures.show', compact('candidature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidature $candidature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidatures = Candidature::findOrFail($id);

        if ($candidatures->statut == 'en attente' || $candidatures->statut == 'terminé') {

            $candidatures->delete();

            return redirect()->back()->with('success', 'La candidature a été supprimée avec succès.');
        } else {
            return redirect()->back()->with('error', 'La candidature ne peut être supprimée car elle est en cours.');
        }
    }

    public function search(Request $request)
    {
        try {
            // Récupérer toutes les catégories pour les options de filtrage
            $categories = Category::all();

            // Récupérer la valeur de recherche depuis la requête
            $search = $request->input('search', '');

            // Effectuer la recherche sur les colonnes 'name', 'firstname', et 'phone', ainsi que sur les noms des catégories
            $candidatures = Candidature::with('category')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('firstname', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                })
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('nom', 'like', "%$search%");
                })
                ->paginate(4);

            // Retourner la vue avec les résultats de recherche
            return view('admin.candidatures.index', compact('candidatures', 'categories', 'search'));
        } catch (Exception $e) {
            // Afficher l'erreur pour le débogage
            dd($e);
        }
    }
    public function createpage($id)
    {
        $candidature = Candidature::findOrFail($id);
        return view('admin.candidatures.createpage', compact('candidature'));
    }

    public function store(StoreEntretiens $request)
    {

        try {
            $entretiens = Interview::create([
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'user_id' => auth()->user()->id,
                'cand_id' => $request->input('cand_id'),
            ]);

            // Mettre à jour le statut du candidat
            $candidat = Candidature::findOrFail($request->cand_id);
            $candidat->statut = 'programmé';
            $candidat->save();

            $candidat = Candidature::with('category')->find($request->cand_id);

            $interview = [
                'date' => $request->date,
                'time' => $request->time,
                'nom' => $candidat->category->nom,           // Nom de la catégorie
                'name' => $candidat->name,         // Nom du candidat
                'firstname' => $candidat->firstname, // Prénom du candidat
                'email' => $candidat->email,       // Email du candidat
            ];

            // Envoyer un mail pour informer le candidat de l'entretien programmé
            Mail::to($interview['email'])->send(new ProgrammeEntretien($interview));

            session()->flash('success', 'Entretien planifié avec succès.');
            return redirect()->route('entretiens.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
