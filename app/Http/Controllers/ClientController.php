<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = [
            'Casablanca', 'Rabat', 'Fes', 'Marrakech', 'Agadir', 'Tangier', 'Meknes', 'Oujda', 'Kenitra', 'Tetouan',
            'Safi', 'El Jadida', 'Nador', 'Khouribga', 'Beni Mellal', 'Ksar El Kebir', 'Larache', 'Khemisset', 
            'Guelmim', 'Berrechid', 'Ouarzazate', 'Al Hoceima', 'Taza', 'Settat', 'Sale', 'Mohammedia', 'Laayoune',
            'Errachidia', 'Inezgane', 'Taroudant', 'Essaouira', 'Tiznit', 'Sidi Kacem', 'Sidi Slimane', 'Youssoufia',
            'Dakhla', 'Azrou', 'Midelt', 'Sefrou', 'Boujdour', 'Tan-Tan', 'Zagora', 'Chefchaouen', 'Taourirt', 
            'Berkane', 'Oued Zem', 'Fnideq', 'Martil', 'Sidi Bennour', 'Bouznika', 'Skhirat', 'Temara', 'Ait Melloul'
        ];
        return view('clients.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:clients,phone',
            'city' => 'required',
            'birthday' => 'required|date|after:1900-01-01|before:today',
        ]);
        Client::create($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cities = [
            'Casablanca', 'Rabat', 'Fes', 'Marrakech', 'Agadir', 'Tangier', 'Meknes', 'Oujda', 'Kenitra', 'Tetouan',
            'Safi', 'El Jadida', 'Nador', 'Khouribga', 'Beni Mellal', 'Ksar El Kebir', 'Larache', 'Khemisset', 
            'Guelmim', 'Berrechid', 'Ouarzazate', 'Al Hoceima', 'Taza', 'Settat', 'Sale', 'Mohammedia', 'Laayoune',
            'Errachidia', 'Inezgane', 'Taroudant', 'Essaouira', 'Tiznit', 'Sidi Kacem', 'Sidi Slimane', 'Youssoufia',
            'Dakhla', 'Azrou', 'Midelt', 'Sefrou', 'Boujdour', 'Tan-Tan', 'Zagora', 'Chefchaouen', 'Taourirt', 
            'Berkane', 'Oued Zem', 'Fnideq', 'Martil', 'Sidi Bennour', 'Bouznika', 'Skhirat', 'Temara', 'Ait Melloul'
        ];
        $client = Client::find($id);
        return view('clients.edit', compact('client', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::find($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:clients,phone,'.$client->id,
            'city' => 'required',
            'birthday' => 'required|date|after:1900-01-01|before:today',
        ]);
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        if($client){
            $client->delete();
            return response()->json(["success"=>true, "message"=>"Client deleted successfully"]);
        }
        return response()->json(["success"=>false, "message"=>"Client not found"]);
    }
}
