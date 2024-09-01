<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfigRequest;
use App\Models\Configuration;
use Exception;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allconfigurations = Configuration::latest()->paginate(10);
        return view('admin.config.index', compact('allconfigurations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.config.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConfigRequest $request)
    {
        try {
            Configuration::create($request->all());
            return redirect()->route('configurations.index')->with('success', 'Configuration ajoute');
        } catch (Exception $e) {
            dd($e);
            throw new Exception('Erreur lors de l\'enregistrement de la configuration');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        try {
            $configuration->delete();
            return redirect()->route('configurations.index')->with('success', 'Configuration retiré');
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la suppresion de la configuration');
        }
    }
}
