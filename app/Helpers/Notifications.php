<?php


namespace App\Helpers;

use App\Models\Configuration;
use App\Models\Interview;
use App\Models\Notif;
use Carbon\Carbon;

class Notifications
{

    public static function getDate()
    {
        // Récupère la date d'aujourd'hui
        $today = now()->toDateString();

        // Étape 1: Récupérer les IDs des entretiens programmés pour aujourd'hui
        $interviewIds = Interview::whereDate('date', $today)->pluck('id');

        // Étape 2: Insérer les notifications pour les entretiens d'aujourd'hui si elles n'existent pas déjà
        foreach ($interviewIds as $interviewId) {
            Notif::firstOrCreate(
                ['interview_id' => $interviewId], // Conditions pour vérifier l'existence
                ['read_at' => 0, 'is_read' => 0, 'temps_notif' => Carbon::now()] // Valeurs par défaut si non existant
            );
        }

        // Étape 3: Compter les notifications non lues et non marquées comme lues
        $count = Notif::whereIn('interview_id', $interviewIds) // Filtrer par les IDs des entretiens
            ->where(function ($query) {
                $query->where('read_at', 0);// Filtrer les notifications non lues (read_at est NULL)
                    // ->orWhere('is_read', false); // Ou non marquées comme lues (is_read est false)
            })
            ->count(); // Compter le nombre de notifications

        // Retourne le nombre de notifications non lues et non marquées comme lues
        return $count;
    }




    public static function getName()
    {
        $today = Carbon::today();

        // Étape 1: Récupérer les IDs des entretiens avec une date <= à la date actuelle
        $interviewIds = Interview::where('date', '=', $today)->pluck('id');

        // Initialisation de la variable notifications
        $notifications = collect();

        // Étape 2: Vérifiez s'il y a des IDs d'entretiens
        if ($interviewIds->isNotEmpty()) {

            // Vérifier s'il existe des notifications pour les IDs d'entretiens avec read_at = false
            // $verifnotif = Notif::whereIn('interview_id', $interviewIds)->where('read_at', 0)->exists();

            $verifnotif = Notif::where('read_at', 0)->get();
            // dd($verifnotifse);
            if ($verifnotif) {

                // dd($verifnotif);
                // Si des notifications avec read_at = false existent, récupérez-les
                $notifications = Notif::where('read_at', 0)
                    ->join('interviews', 'interviews.id', '=', 'notification.interview_id') // Jointure avec la table entretiens
                    ->select('notification.*', 'interviews.time', 'interviews.date') // Sélectionner les colonnes nécessaires
                    ->with('interviews.candidatures') // Charger les relations nécessaires
                    ->orderBy('interviews.date', 'asc') // Trier par date en ordre croissant
                    ->orderBy('interviews.time', 'asc') // Trier par heure en ordre croissant
                    ->get();
            }


            // Formate les résultats
            $result = $notifications->map(function ($notif) {
                $interview = $notif->interviews;
                $candidature = $interview->candidatures;

                return [
                    'id' => $notif->id,
                    'name' => $candidature->name,
                    'firstname' => $candidature->firstname,
                    'motivation' => $candidature->motivation,
                    'time' => $interview->time, // Utilisation du temps de l'entretien
                ];
            });


            return $result;
        }
    }





    public static function getNom()
    {
        $appName = Configuration::where('type', 'APP_NAME')->value('value');

        return $appName;
    }


    // public function getNotifications()
    // {
    //     // Récupérer les entretiens du jour, triés par heure
    //     $todayNotifications = Interview::whereDate('date', now()->format('Y-m-d'))
    //         ->where('status', 'scheduled') // statut programmé
    //         ->orderBy('time')
    //         ->take(2)
    //         ->get();

    //     return $todayNotifications;
    // }
}
