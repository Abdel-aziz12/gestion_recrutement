<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Calendar;
use App\Models\Candidature;
use App\Models\Category;
use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {


        $currentDate = Carbon::now()->day;


        $today = now()->toDateString();

        $candidaturestotal = Candidature::all()->count();
        $candidaturesretenue = Candidature::where('statut', 'terminé')->count();
        $entretiensprogramme = Candidature::where('statut', 'programme')->count();
        $entretienstermine = Candidature::where('statut', 'terminé')->count();
        $categoriespostes = Category::where('is_active', 1)->count();

        $interviews = Interview::with('candidatures')->get(); // Assurez-vous que le nom de la relation est correct: 'candidature'

        $events = [];

        foreach ($interviews as $interview) {
            $status = $interview->candidatures->statut; // Récupère le statut de la candidature

            // Définir la couleur en fonction du statut
            $color = '';
            if ($status == 'programmé') {
                $color = 'yellow';
            } elseif ($status == 'terminé') {
                $color = 'green';
            }

            // Ajouter l'événement au tableau d'événements
            $events[] = [
                'title' => $status,
                'start' => $interview->date . ' ' . $interview->time, // Combiner date et heure
                'end' => $interview->date . ' 24:00:00', // Vous pouvez ajuster l'heure de fin selon vos besoins
                'statut' => $interview->candidatures->statut == 'terminé' ? 'green' : 'yellow',
                'id' => $interview->id
            ];
        }
        // dd($events);

        // Retourner la vue avec les variables compactées
        return view('admin.dashboard.index', compact('candidaturestotal', 'candidaturesretenue', 'categoriespostes', 'entretiensprogramme', 'entretienstermine', 'events'));
    }

        public function getEntretiens()
    {
        $interviews = Interview::with('candidatures')->get();


        return response()->json($interviews->map(function($entretien) {
            return [
                'id' => $entretien->id,
                'title' => $entretien->candidatures->statut,
                'start' => $entretien->date . 'T' . $entretien->time,
                // 'status' => $entretien->candidatures->statut,
            ];
        }));
    }

    // public function index()
    // {

    //     // Nombre total de candidatures
    //     $totalCandidatures = Candidature::count();

    //     // Nombre d'entretiens programmés pour aujourd'hui
    //     $today = Carbon::today();
    //     $entretiensToday = Interview::whereDate('date', $today)->count();

    //     // Statut des candidatures
    //     $statuts = Candidature::selectRaw('statut, COUNT(*) as count')
    //         ->groupBy('statut')
    //         ->pluck('count', 'statut');

    //     // Nombre de postes ouverts
    //     $postesOuverts = Category::where('is_active', 1)->count();


    //     // Graphique des candidatures par mois
    //     $candidaturesParMois = Candidature::selectRaw('MONTHNAME(created_at) as month, COUNT(*) as count')
    //         ->groupBy('month')
    //         ->pluck('count', 'month');

    //     $months = $candidaturesParMois->keys();
    //     $candidatureCounts = $candidaturesParMois->values();


    //     // Notifications
    //     $newCandidatures = Candidature::where('statut', 'en attente')->orderBy('created_at', 'desc')->limit(5)->get();
    //     $rappelsEntretiens = Interview::with(['candidatures' => function ($query) {
    //         $query->where('statut', 'programme');
    //     }])
    //         ->whereDate('date', '>=', now()) // Entretiens à partir d'aujourd'hui
    //         ->orderBy('date') // Trier par date
    //         ->limit(5) // Limiter à 5 résultats
    //         ->get();


    //     // FullCalendar des entretiens
    //     $interviews = Interview::with('candidatures')->get();

    //     // Utilisez `map` sur la collection obtenue
    //     $events = $interviews->map(function ($interview) {
    //         // Assurez-vous que `candidatures` est une collection et que vous accédez correctement aux propriétés
    //         // Note : `candidatures` peut contenir plusieurs candidatures. Ici, on suppose qu'on veut la première.
    //         $candidature = $interview->candidatures->first(); // ou `->last()` ou une autre logique selon vos besoins

    //         return [
    //             'firstname' => $candidature ? $candidature->firstname : 'N/A',
    //             'date' => $interview->date,
    //             'statut' => $candidature && $candidature->statut == 'terminé' ? 'green' : 'yellow'
    //         ];
    //     });




    //     return view('admin.dashboard.index', compact(
    //         'totalCandidatures',
    //         'entretiensToday',
    //         'statuts',
    //         'postesOuverts',
    //         'months',
    //         'candidatureCounts',
    //         'newCandidatures',
    //         'rappelsEntretiens',
    //         'events'
    //     ));
    // }



    // public function index()
    // {
    //     // Récupérer les statistiques générales
    //     $totalCandidatures = Candidature::count();
    //     $entretiensToday = Interview::whereDate('date', now()->toDateString())->count();
    //     $postesOuverts = Category::where('is_active', 1)->count();

    //     // Récupérer le nombre de candidatures par statut
    //     $statuts = Candidature::select('statut', DB::raw('count(*) as count'))
    //         ->groupBy('statut')
    //         ->pluck('count', 'statut')
    //         ->toArray();

    //     // Préparer les données pour les graphiques
    //     $months = Candidature::select(DB::raw('MONTHNAME(created_at) as month'))
    //         ->groupBy('month')
    //         ->orderBy('created_at', 'asc')
    //         ->pluck('month')
    //         ->toArray();

    //     $candidatureCounts = Candidature::select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('count(*) as count'))
    //         ->groupBy('month')
    //         ->orderBy('created_at', 'asc')
    //         ->pluck('count', 'month')
    //         ->toArray();

    //     $postLabels = Category::pluck('nom')->toArray();
    //     $postCounts = Category::withCount('candidatures')
    //         ->pluck('candidatures_count')
    //         ->toArray();

    //     // Récupérer les nouvelles candidatures
    //     $newCandidatures = Candidature::where('created_at', '>=', now()->subDays(7))->get();

    //     // Récupérer les rappels d'entretien
    //     $rappelsEntretiens = Interview::with('candidatures')
    //         ->whereDate('date', '>=', now())
    //         ->whereHas('candidatures', function ($query) {
    //             $query->where('statut', 'programme');
    //         })
    //         ->orderBy('date')
    //         ->limit(5)
    //         ->get();

    //     // Préparer les événements pour le calendrier
    //     $events = Interview::with('candidatures')
    //         ->whereDate('date', '>=', now())
    //         ->get()
    //         ->map(function ($interview) {
    //             return [
    //                 'title' => $interview->candidatures->first()->name ?? 'Candidat inconnu',
    //                 'start' => $interview->date,
    //                 'backgroundColor' => $interview->candidatures->first()->statut == 'terminé' ? 'green' : 'yellow'
    //             ];
    //         });



    //     // Graphique des candidatures par mois
    //     $candidaturesParMois = Candidature::selectRaw('MONTHNAME(created_at) as month, COUNT(*) as count')
    //         ->groupBy('month')
    //         ->pluck('count', 'month');

    //     $months = $candidaturesParMois->keys();
    //     $candidatureCounts = $candidaturesParMois->values();


    //     // Passer les données à la vue
    //     return view('admin.dashboard.index', compact(
    //         'totalCandidatures', 'candidatureCounts','candidaturesParMois',
    //         'entretiensToday',
    //         'postesOuverts',
    //         'statuts',
    //         'months',
    //         'candidatureCounts',
    //         'postLabels',
    //         'postCounts',
    //         'newCandidatures',
    //         'rappelsEntretiens',
    //         'events'
    //     ));
    // }
}
