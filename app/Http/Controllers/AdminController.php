<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\SubmitDefineAccess;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\ResetCodePassword;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification as FacadesNotification;


class AdminController extends Controller
{
    public function index()
    {
        $admins = User::paginate(10);
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function edit(User $user)
    {
        return view('admins.edit', compact("user"));
    }

    // Enregistre un Admin et lui envoyer un mail
    public function store(StoreAdminRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            if ($user) {
                // Supprimer les anciens codes de réinitialisation
                ResetCodePassword::where('email', $user->email)->delete();
                // Générer un nouveau code
                $code = rand(1000, 4000);
                $data = [
                    'code' => $code,
                    'email' => $user->email,
                ];
                ResetCodePassword::create($data);

                try {
                    \Log::info('Tentative d\'envoi d\'email à : ' . $user->email);
                    $user->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));
                    \Log::info('Email envoyé avec succès');

                    return redirect()->route('administrateurs.index')
                        ->with('success', 'Administrateur créé avec succès. Un email de confirmation a été envoyé.');
                } catch (\Exception $e) {
                    \Log::error('Erreur d\'envoi d\'email : ' . $e->getMessage());
                    // On continue même si l'email échoue
                    return redirect()->route('administrateurs.index')
                        ->with('warning', 'Administrateur créé avec succès, mais l\'envoi de l\'email a échoué.');
                }
            }
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de l\'administrateur : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'administrateur : ' . $e->getMessage());
        }
    }
    public function defineAccess($email){
        //dd($email);
        $checkUserExist = user::where('email',$email)->first();
        if($checkUserExist){
            return view('auth.validate-account',compact('email'));
        }else{
            //si le compte n'existe pas on va le rediriger sur une route 404
            return redirect()->route('login');
        }
    }

    public function submitDefineAccess(SubmitDefineAccess $request, $email)
    {
        // La validation des champs (email, code, password, confirm_password) est gérée par SubmitDefineAccess Request

        try {
            // Trouver l'utilisateur par email depuis l'URL
            $user = User::where('email', $email)->first();

            // Vérifier si l'utilisateur existe et si le code soumis est valide
            $resetCode = ResetCodePassword::where('email', $email)
                                          ->where('code', $request->code)
                                          ->first();

            if ($user && $resetCode) {
                // Mettre à jour le mot de passe de l'utilisateur
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now(); // Marquer l'email comme vérifié
                $user->update();

                // Supprimer le code de réinitialisation après utilisation
                $resetCode->delete();

                // Rediriger vers la page de connexion avec un message de succès
                return redirect()->route('login')->with('success_message', 'Votre compte a été validé et votre mot de passe mis à jour. Vous pouvez maintenant vous connecter.');
            } else {
                // Si l'utilisateur n'existe pas ou le code est invalide/expiré
                // Supprimer le code s'il existe (même s'il est invalide pour cet email ou expiré)
                 if ($resetCode) {
                     $resetCode->delete();
                 }
                return redirect()->route('login')->with('error_message', 'Le code de validation est invalide ou a expiré.');
            }

        } catch (\Exception $e) {
            // Log l'erreur et rediriger avec un message d'erreur générique
            \Log::error('Erreur lors de la définition des accès : ' . $e->getMessage());
            return redirect()->route('login')->with('error_message', 'Une erreur est survenue lors de la validation de votre compte.');
        }
    }

    public function update(UpdateAdminRequest $request, User $user)
    {
        try {
            // ...
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function delete(User $user)
    {
        try {
            $connectedId = Auth::user()->id;
            if($connectedId != $user->id){
                $user->delete();
                return redirect()->back()->with('success_message', 'L administrateur a ete retirer.');
            }else{
                return redirect()->back()->with('error_message', 'Vous ne pouvez pas supprimer votre compte.');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
