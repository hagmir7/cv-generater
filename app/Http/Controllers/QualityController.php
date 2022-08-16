<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use Illuminate\Http\Request;

class QualityController extends Controller
{
    public function create(Request $request, $id){
        $request->validate([
            'quality' => 'required|max:100', 
        ]);


        $quality = Quality::create([
            'quality' => $request->input('quality'),
            'person_id' => $id
        ]);
        return ['id' => $quality->id];
    }


    public function update(Request $request, $id){
        $request->validate([
            'quality' => 'required|max:100', 
        ]);


        Quality::find($id)->update([
            'quality' => $request->input('quality'),
        ]);

        return [
            'message' => 'quality updated successfully...',
            'quality' => Quality::query()->find($id) 
                
        ];
    }



    public function get($id){
        $quality = Quality::query()->findOrFail($id);
        return ['quality' => $quality];
    }


    public function delete($id)
    {
        Quality::query()->find($id)->delete();
        return ['message' => 'quality deleted successfully...'];
    }
}
