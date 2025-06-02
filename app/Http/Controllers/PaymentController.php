<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Employe;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
            $paymentDateConfig = Configuration::where('type', 'PAYMENT_DATE')->first();
            $paymentDay = intval($paymentDateConfig->value);
            $today = date('d');
            $isPaymentDay = false;
            if($today ==$paymentDay){
                $isPaymentDay = true;
            }
        $payments = Payment::latest()->orderBy('id', 'desc')->paginate(10);
        return view('paiements.index', compact('payments', 'isPaymentDay'));
    }

    public function initPayment(){
        //dd('ok');
        $monthMapping = [
                'JANUARY' => 'JANVIER',
                'FEBRUARY' => 'FÉVRIER',
                'MARCH' => 'MARS',
                'APRIL' => 'AVRIL',
                'MAY' => 'MAI',
                'JUNE' => 'JUIN',
                'JULY' => 'JUILLET',
                'AUGUST' => 'AOÛT',
                'SEPTEMBER' => 'SEPTEMBRE',
                'OCTOBER' => 'OCTOBRE',
                'NOVEMBER' => 'NOVEMBRE',
                'DECEMBER' => 'DÉCEMBRE'
                ];
        $currentMonth = strtoupper(Carbon::now()->formatLocalized('%B'));
         //dd($currentMonth);
         //mois en cours en français
         $currentMonthInFrench = $monthMapping[$currentMonth] ?? '';
         //dd($currentMonthInFrench);
         // Année en cours
         $currentYear = Carbon::now()->format('Y');
        //dd($currentYear);
        //similer les paiements pour tout les employers dans le mois en cours. Les payments concerne les employers qui n'ont pas encore été payés pour le mois en cours
//Recuperer la liste des employeurs qui n'ont pas encore été payés pour le mois en cours
        $employers = Employe::whereDoesntHave('payments', function($query) use ($currentMonthInFrench, $currentYear) {
            $query->where('month', '=',$currentMonthInFrench)
                  ->where('year','=', $currentYear);
        })->get();

        if($employers->count() == 0){
            return redirect()->back()->with('error_message', 'Tout vos employees ont été payés pour ce mois de '. $currentMonthInFrench . ' ' . $currentYear);
        }
            //dd($employers);


        //faire les payments pour ces employeurs

        foreach($employers as $employe){
            $aEtePayer = $employe->payments()->where('month', '=', $currentMonthInFrench)
                ->where('year', '=', $currentYear)
                ->exists();
                if (!$aEtePayer){
                    $salaire =$employe->montant_journalier * 31;
                    $payment = new Payment([
                        'reference' =>strtoupper(Str::random(10)),
                        'employer_id' => $employe->id,
                        'amount' => $salaire,
                        'launch_date' => now(),
                        'done_time' => now(),
                        'status' => 'SUCCESS',
                        'month' => $currentMonthInFrench,
                        'year' => $currentYear
                    ]);
                    $payment->save();
                }
        }
        //Redidriger l'utulisateur vers la page des paiements avec un message de succès
        return redirect()->back()->with('success_message', 'Les paiements ont été initialisés avec succès pour le mois de ' . $currentMonthInFrench . ' ' . $currentYear);
    }
    //telechargenmet de la facture de paiement
    public function downloadInvoice(Payment $payment)
    {
        try {
            $fullPaymentInfos = Payment::with('employe')->find($payment->id);

            $pdf = \PDF::loadView('paiements.facture', [
                'fullPaymentInfos' => $fullPaymentInfos,
                'total_fees' => 0,
                'total_paid' => $fullPaymentInfos->amount,
                'remaining_to_pay' => 0
            ]);

            return $pdf->download('facture-paiement-' . $fullPaymentInfos->reference . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Une erreur est survenue lors du téléchargement de la facture: ' . $e->getMessage());
        }
    }
}
