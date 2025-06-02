<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeConfigRequest;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display configurations
        $allconfig= Configuration::latest()->paginate(10);
        return view('config.index', compact('allconfig'));
    }
    public function create()
    {
        // Logic to show the form for creating a new configuration
        return view('config.create');
    }
    public function store(storeConfigRequest $request){

        try
        {
              Configuration::create($request->all());
              return redirect()->route('configurations')->with('success', 'Configuration ajouter avec success!');
        }catch(\Exception $e)
        {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the configuration: ' . $e->getMessage());
        }

    }
    public function delete(Configuration $configuration)
    {
        // Logic to delete a configuration
        try {
            $configuration->delete();
            return redirect()->route('configurations')->with('success', 'Configuration supprimer avec success !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the configuration: ' . $e->getMessage());
        }
    }
}
