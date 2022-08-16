<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function create(Request $request, $id){
        $request->validate([
            'experience' => 'required|max:50', 
            'company' => 'required|max:30', 
            'start_date' => 'required|date', 
            'end_date' => 'date',
            'city' => 'required|max:30', 
            'description' => 'required|max:150'
        ]);


        $experience = Experience::create([
            'experience' => $request->input('experience'),
            'company' => $request->input('company'),
            'start_date' => $request->input('start_date'), 
            'end_date' => $request->input('end_date'), 
            'city' => $request->input('city'), 
            'description'=> $request->input('description'),
            'person_id' => $id
        ]);
        return ['id' => $experience->id];
    }


    public function update(Request $request, $id){
        $request->validate([
            'experience' => 'required|max:50', 
            'company' => 'required|max:30', 
            'start_date' => 'required|date', 
            'end_date' => 'date',
            'city' => 'required|max:30', 
            'description' => 'required|max:150'
        ]);


        Experience::find($id)->update([
            'experience' => $request->input('experience'),
            'company' => $request->input('company'),
            'start_date' => $request->input('start_date'), 
            'end_date' => $request->input('end_date'), 
            'city' => $request->input('city'), 
            'description'=> $request->input('description'),
        ]);

        return [
            'message' => 'Experience updated successfully...',
            'experience' => Experience::query()->find($id) 
                
        ];
    }



    public function get($id){
        $experience = Experience::query()->findOrFail($id);
        return ['experience' => $experience];
    }


    public function delete($id)
    {
        Experience::query()->find($id)->delete();
        return ['message' => 'Experience deleted successfully...'];
    }

    
}
