<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Models\Employe;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;

class EmployeController extends Controller
{
public function index()
{
    $employes = Employe::with('departement')->paginate(10);
    return view('employers.index', compact('employes'));
}

    public function create (){
        $departements = Departement::all();
        return view('employers.create', compact('departements'));
    }

    public function store(StoreEmployeRequest $request){
        try {
            $requet = Employe::create($request->all());
            return redirect()->route('employers.index')->with('success', 'Employé créé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de l\'employé');
        }
    }

    public function edit(Employe $employe)
    {
        $departements = Departement::all();
        return view('employers.edit', compact('employe', 'departements'));
    }

    public function update(Employe $employe,UpdateEmployeRequest $request)
    {
        try {
            $employe->nom = $request->nom;
            $employe->prenom = $request->prenom;
            $employe->email = $request->email;
            $employe->contact = $request->contact;
            $employe->departement_id = $request->departement_id;
            $employe->montant_journalier = $request->montant_journalier;
            // Update the employe with the validated data
            $employe->update();
            return redirect()->route('employers.index')->with('success', 'Employé mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour de l\'employé');
        }

    }
    public function delete(Employe $employe)
    {
        try {
            $employe->delete();
            return redirect()->route('employers.index')->with('success', 'Employé supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de l\'employé');
        }
    }
}








