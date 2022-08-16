<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function create(Request $request, $id){
        $request->validate([
            'skill' => 'required|max:50', 
            'level' => 'required', 
        ]);


        $skill = Skill::create([
            'skill' => $request->input('skill'),
            'level' => $request->input('level'),
            'person_id' => $id
        ]);
        return [
            'skill' => $skill,
            'message' => "Skill created successfully..."
        
        ];
    }


    public function update(Request $request, $id){
        $request->validate([
            'skill' => 'required|max:50', 
            'level' => 'required'
        ]);


        Skill::find($id)->update([
            'skill' => $request->input('skill'),
            'level' => $request->input('level'),
        ]);

        return [
            'message' => 'Skill updated successfully...',
            'skill' => Skill::query()->find($id) 
                
        ];
    }



    public function get($id){
        $skill = Skill::query()->findOrFail($id);
        return ['skill' => $skill];
    }


    public function delete($id)
    {
        Skill::query()->find($id)->delete();
        return ['message' => 'skill deleted successfully...'];
    }
}
