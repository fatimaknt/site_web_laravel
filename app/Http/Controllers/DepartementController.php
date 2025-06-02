<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
     public function index(){
        $departements = Departement::paginate(10);

        return view ('departements.index',compact( 'departements' ));
    }

    public function create (){
        $departements = Departement::paginate(10);

        return view('departements.create', compact('departements'));
    }

    public function edit(Departement $departement)
    {
        return view ('departements.edit',compact('departement'));
    }

    public function store(Departement $departement , saveDepartementRequest $request)
    {
        try
        {
               $departement ->nom =$request->nom;
               $departement->save();
        return redirect()->route('departements.index')->with('success', 'Departement created successfully');

        }catch (\Exception $e){
                     dd($e->getMessage());
        }

    }

        public function update(Departement $departement , saveDepartementRequest $request)
    {
        try
        {
               $departement ->nom =$request->nom;
               $departement->update();
        return redirect()->route('departements.index')->with('success', 'Departement update successfully');

        }catch (\Exception $e){
                     dd($e->getMessage());
        }

    }

        public function delete(Departement $departement)
        {
            try
                {
                $departement->delete();
            return redirect()->route('departements.index')->with('success', 'Departement delete successfully');

                } catch (\Exception $e){
                            dd($e->getMessage());
                }

            }



}


