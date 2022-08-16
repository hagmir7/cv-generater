<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    public function create(Request $request, $id){
        $request->validate([
            'diplome' => 'required|max:100', 
            'establishment' => 'required|max:100', 
            'date_obtained' => 'required|date', 
            'city' => 'required|max:50', 
            'description' => 'required|max:150'
        ]);


        $diplome = Diplome::create([
            'diplome' => $request->input('diplome'),
            'establishment' => $request->input('establishment'),
            'date_obtained' => $request->input('date_obtained'), 
            'city' => $request->input('city'), 
            'description'=> $request->input('description'),
            'person_id' => $id
        ]);
        return [
            'diplome' => $diplome,
            'message' => "Diplome created successfully..."
        ];
    }


    public function update(Request $request, $id){
        $request->validate([
            'diplome' => 'required|max:100', 
            'establishment' => 'required|max:100', 
            'date_obtained' => 'required|date', 
            'city' => 'required|max:50', 
            'description' => 'required|max:150'
        ]);


        Diplome::find($id)->update([
            'diplome' => $request->input('diplome'),
            'establishment' => $request->input('establishment'),
            'date_obtained' => $request->input('date_obtained'), 
            'city' => $request->input('city'), 
            'description'=> $request->input('description'),
        ]);

        return [
            'message' => 'Diplome updated successfully...',
            'diplome' => Diplome::query()->find($id) 
                
        ];
    }



    public function get($id){
        $diplome = Diplome::query()->findOrFail($id);
        return ['diplome' => $diplome];
    }


    public function delete($id)
    {
        Diplome::query()->find($id)->delete();
        return ['message' => 'Diplome deleted successfully...'];
    }
}
