<?php

namespace App\Http\Controllers;

use App\Models\Notification; // Assurez-vous que vous avez ce modèle
use App\Models\Interview;
use App\Models\Notif;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // Récupère la date du jour
    //     $currentDate = Carbon::today();

    //     // Étape 1: Récupérer les IDs des entretiens avec une date <= à la date actuelle
    //     $interviewIds = Interview::where('date', '<=', $currentDate)->pluck('id');

    //     // Initialisation de la variable notifications
    //     $notifications = collect();

    //     // Étape 2: Vérifiez s'il y a des IDs d'entretiens
    //     if ($interviewIds->isNotEmpty()) {

    //         // Vérifier s'il existe des notifications pour les IDs d'entretiens avec read_at = true
    //         $verifnotif = Notif::whereIn('interview_id', $interviewIds)->where('read_at', true)->exists();

    //         if ($verifnotif) {
    //             // Si des notifications ont déjà read_at à true, récupérez-les
    //             $notifications = Notif::whereIn('interview_id', $interviewIds)
    //                 ->with('interview.candidatures') // Charger les relations nécessaires
    //                 ->get();
    //         } else {
    //             // Étape 3: Créer de nouvelles notifications pour chaque ID d'entretien
    //             foreach ($interviewIds as $interviewId) {
    //                 // Crée une nouvelle notification
    //                 Notif::updateOrCreate(
    //                     ['interview_id' => $interviewId], // Condition pour l'update
    //                     [
    //                         'read_at' => false, // Valeur par défaut pour read_at
    //                         'is_read' => false, // Valeur par défaut pour is_read
    //                         'temps_notif' => Carbon::now(), // Temps actuel pour la notification
    //                     ]
    //                 );
    //             }

    //             // Étape 4: Mettre à jour les notifications existantes pour read_at à true
    //             Notif::whereIn('interview_id', $interviewIds)
    //                 ->update(['read_at' => true]);

    //             // Récupérer toutes les notifications mises à jour pour affichage
    //             $notifications = Notif::whereIn('interview_id', $interviewIds)
    //                 ->with('interview.candidatures') // Charger les relations nécessaires
    //                 ->get();
    //         }
    //     }

    //     // Retourner la vue avec les notifications
    //     return view('admin.notification.index', compact('notifications'));
    // }

    public function index()
    {
        // Récupère la date du jour
        $currentDate = Carbon::today();

        // Étape 1: Récupérer les IDs des entretiens avec une date <= à la date actuelle
        $interviewIds = Interview::where('date', '<=', $currentDate)->pluck('id');

        // Initialisation de la variable notifications
        $notifications = collect();

        // Étape 2: Vérifiez s'il y a des IDs d'entretiens
        if ($interviewIds->isNotEmpty()) {

            // Vérifier s'il existe des notifications pour les IDs d'entretiens avec read_at = true
            $verifnotif = Notif::whereIn('interview_id', $interviewIds)->where('read_at', true)->exists();

            if ($verifnotif) {
                // Si des notifications ont déjà read_at à true, récupérez-les
                $notifications = Notif::whereIn('interview_id', $interviewIds)
                    ->join('interviews', 'interviews.id', '=', 'notification.interview_id') // Jointure avec la table entretiens
                    ->select('notification.*', 'interviews.time', 'interviews.date') // Sélectionner les colonnes nécessaires
                    ->with('interviews.candidatures') // Charger les relations nécessaires
                    ->orderBy('interviews.date', 'asc') // Trier par date en ordre croissant
                    ->orderBy('interviews.time', 'asc') // Trier par temps_notif en ordre croissant
                    ->get();
            } else {
                // Étape 3: Créer de nouvelles notifications pour chaque ID d'entretien
                foreach ($interviewIds as $interviewId) {
                    // Crée une nouvelle notification
                    Notif::updateOrCreate(
                        ['interview_id' => $interviewId], // Condition pour l'update
                        [
                            'read_at' => false, // Valeur par défaut pour read_at
                            'is_read' => false, // Valeur par défaut pour is_read
                        ]
                    );
                }

                // Étape 4: Mettre à jour les notifications existantes pour read_at à true
                Notif::whereIn('interview_id', $interviewIds)
                    ->update(['read_at' => true]);

                // Récupérer toutes les notifications mises à jour pour affichage
                $notifications = Notif::whereIn('interview_id', $interviewIds)
                    ->join('interviews', 'interviews.id', '=', 'notification.interview_id') // Jointure avec la table entretiens
                    ->select('notification.*', 'interviews.time', 'interviews.date') // Sélectionner les colonnes nécessaires
                    ->with('interviews.candidatures') // Charger les relations nécessaires
                    ->orderBy('interviews.date', 'asc') // Trier par date en ordre croissant
                    ->orderBy('interviews.time', 'asc') // Trier par temps_notif en ordre croissant
                    ->get();
            }
        }

        // Retourner la vue avec les notifications
        return view('admin.notification.index', compact('notifications'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        // Récupérer la notification avec ses relations
        $notifications = Notif::with('interviews.candidatures')
            ->where('read_at', 0)
            ->findOrFail($id);
        // Vérifier l'état actuel de `read_at` et `is_read`
        if ($notifications->read_at == 0) {
            // Si `read_at` est `false`, le définir à la date actuelle et mettre `is_read` à `true`
            $notifications->read_at = 1;
            $notifications->is_read = 1;
        } else {
            if ($notifications->is_read == 0) {
                // Si `read_at` est déjà `true` mais `is_read` est `false`, on le définit à `true`
                $notifications->is_read = 1;
            }
        }


        // Sauvegarder les modifications
        $notifications->save();

        // Passer la notification à la vue
        return view('admin.notification.show', compact('notifications'));
    }



    /**
     * Mark all notifications as read.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllAsRead()
    {
        $today = now()->toDateString();
        Interview::whereDate('date', $today)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark notifications as read via AJAX request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Request $request)
    {
        // Marquer les notifications comme lues
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    // Les méthodes inutilisées peuvent être supprimées si elles ne sont pas nécessaires.
    public function create() {}

    public function store(Request $request) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
