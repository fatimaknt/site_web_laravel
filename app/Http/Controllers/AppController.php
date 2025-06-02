<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employe;
use App\Models\User;
use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(){
        $totalsDepartement = Departement::count();
        $totalsEmploye = Employe::count();
        $totalsAdministrateurs = User::count();

        $paymentNotification = null;

        // On cherche la configuration de la date de paiement
        $paymentDateConfig = Configuration::where('type', 'PAYMENT_DATE')->first();

        if ($paymentDateConfig && is_numeric($paymentDateConfig->value)) {
            $paymentDay = intval($paymentDateConfig->value);
            $currentDay = Carbon::now()->day;

            if ($currentDay < $paymentDay) {
                $paymentNotification = "Le paiement est prévu pour le $paymentDay de ce mois.";
            } else {
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->locale('fr_FR')->isoFormat('MMMM');
                $paymentNotification = "Le prochain paiement aura lieu le $paymentDay $nextMonthName.";
            }
        } else {
            $paymentNotification = "Aucune date de paiement configurée.";
        }

        return view('dashboard', compact(
            'totalsDepartement',
            'totalsEmploye',
            'totalsAdministrateurs',
            'paymentNotification'
        ));
    }
}





