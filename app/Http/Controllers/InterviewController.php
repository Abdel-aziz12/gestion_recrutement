<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntretiens;
use App\Http\Requests\updateEntretiens;
use App\Mail\ProgrammeEntretien;
use App\Mail\SendEmailToCandidatProgrammeEntretien as MailSendEmailToCandidatProgrammeEntretien;
use App\Models\Candidature;
use App\Models\Category;
use App\Models\Interview;
use App\Models\User;
use App\Notifications\SendEmailToCandidatProgrammeEntretien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Helpers\Notifications;
use App\Mail\ModificationEmail;

class InterviewController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statut = $request->input('statut');
        $categoryId = $request->input('category_id');

        $entretiens = Interview::with(['candidatures.category'])
            ->when($statut && $statut !== 'all', function ($query) use ($statut) {
                return $query->whereHas('candidatures', function ($query) use ($statut) {
                    $query->where('statut', $statut);
                });
            })
            ->when($categoryId && $categoryId !== 'all', function ($query) use ($categoryId) {
                return $query->whereHas('candidatures', function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(4);

        // Récupérer les catégories associées aux entretiens
        $categories = Category::whereHas('candidatures', function ($query) {
            $query->whereHas('interviews');
        })->distinct()->get();

        return view('admin.entretiens.index', compact('entretiens', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $candidatures = Candidature::where('statut', 'en attente')->get();

        return view('admin.entretiens.create', compact('candidatures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntretiens $request)
    {
        try {

            $entretiens = Interview::create([
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'user_id' => auth()->user()->id,
                'cand_id' => $request->input('cand_id')
            ]);

            // Récupérer le candidat associé à l'entretien
            $candidat = Candidature::findOrFail($request->cand_id);

            // Mettre à jour le statut du candidat
            $candidat->statut = 'programmé';
            $candidat->save();

            $entretiens = Interview::with(['candidatures.category'])->find($entretiens->id);


            $nomentreprise = Notifications::getNom();

            $inter = [
                'date' => $entretiens->date,
                'time' => $entretiens->time,
                'nom' => $entretiens->candidatures->category->nom,           // Nom de la catégorie
                'name' => $entretiens->candidatures->name,         // Nom du candidat
                'firstname' => $entretiens->candidatures->firstname, // Prénom du candidat
                'email' => $entretiens->candidatures->email,       // Email du candidat
                'nomentre' => $nomentreprise,
                'nomuse' => auth()->user()->name,
            ];

            // dd($interview);

            // Envoyer un mail pour informer le candidat de l'entretien programmé
            Mail::to($inter['email'])->send(new ProgrammeEntretien($inter));

            // session()
            return redirect()->route('entretiens.index')->with('success', 'L\'entretien a été programmé et un email a été envoyé au candidat.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    // Affiche le formulaire pour éditer un entretien
    public function edit($id)
    {
        $entretien = Interview::with('candidatures')->findOrFail($id);
        $candidatures = Candidature::all();
        return view('admin.entretiens.edit', compact('entretien', 'candidatures'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */

    public function update(updateEntretiens $request, $id)
    {
        try {

            $entretiens = Interview::with('candidatures.category')->findOrFail($id);

            $entretiens->date = $request->date;
            $entretiens->time = $request->time;



            $entretiens->update();

            $nomentre = Notifications::getNom();
            $entretiense = Interview::with(['candidatures.category'])->find($entretiens->id);

            // dd($entretiense);

            $modif = [
                'date' => $entretiense->date,
                'time' => $entretiense->time,
                'nom' => $entretiense->candidatures->category->nom,
                'name' => $entretiense->candidatures->name,
                'firstname' => $entretiense->candidatures->firstname,
                'email' => $entretiense->candidatures->email,
                'nomentre' => $nomentre,
                'nomuse' => auth()->user()->name,
                'datee' =>$entretiense->created_at->format('d/m/Y')
            ];

            // dd($modif);
            // Envoyer un mail pour informer le candidat de l'entretien programmé
            Mail::to($modif['email'])->send(new ModificationEmail($modif));

            // Ajouter un message flash de succès
            session()->flash('success', 'Entretien mis à jour avec succès.');

            return redirect()->route('entretiens.index');
        } catch (Exception $e) {
            // Gérer l'exception en affichant l'erreur
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Trouver l'entretien par ID
        $entretien = Interview::findOrFail($id);

        // Vérifier si le statut du candidat est "terminé"
        if ($entretien->candidatures && $entretien->candidatures->statut === 'terminé') {
            // Supprimer l'entretien
            $entretien->delete();

            // Envoyer des notifications par email ou SMS ici

            session()->flash('success', 'Entretien supprimé avec succès.');
        }

        return redirect()->route('entretiens.index');
    }



    public function updateStatut(Request $request, $id)
    {

        // Validation des données
        $validatedData = $request->validate([
            'statut' => 'required|string'
        ]);

        // Trouver l'entretien avec ses candidatures
        $entretien = Interview::findOrFail($id);

        // Récupérer la première candidature avec le statut 'en attente'
        $candidatures = $entretien->candidatures;
        $candidatures->statut = $request->input('statut');

        $candidatures->save();

        session()->flash('success', 'Statut de l\'entretien mis à jour avec succès.');

        return redirect()->route('entretiens.index');

        // if ($candidatures && $candidatures->statut === 'programmé') {
        //     // Mettre à jour le statut de la candidature
        //     $candidatures->statut = $validatedData['statut'];

        //     $candidatures->save();

        //     // Flash message pour succès

        // } else {
        //     // Flash message pour erreur si la candidature n'existe pas ou si le statut n'est pas 'en attente'
        //     session()->flash('error', 'Candidature introuvable ou statut déjà mis à jour.');

        //     return redirect()->route('entretiens.index');
        // }
    }

    public function search(Request $request)
    {
        try {
            // Récupérer la valeur de recherche depuis la requête
            $search = $request->input('search');


            // Effectuer la recherche sur les informations des candidatures, catégories, date et heure des entretiens
            $entretiens = Interview::with(['candidatures.category'])
                ->where(function ($query) use ($search) {
                    $query->where('date', 'like', "%$search%")
                        ->orWhere('time', 'like', "%$search%");
                })

                ->orWhereHas('candidatures', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('firstname', 'like', "%$search%");
                })

                ->orWhereHas('candidatures.category', function ($query) use ($search) {
                    $query->where('nom', 'like', "%$search%");
                })
                ->paginate(4);


            // Récupérer les catégories associées aux entretiens
            $categories = Category::whereHas('candidatures', function ($query) {
                $query->whereHas('interviews');
            })->distinct()->get();

            // dd($entretiens);

            // Retourner la vue avec les résultats de recherche
            return view('admin.entretiens.index', compact('entretiens', 'categories', 'search'));
        } catch (Exception $e) {
            // Afficher l'erreur pour le débogage
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
