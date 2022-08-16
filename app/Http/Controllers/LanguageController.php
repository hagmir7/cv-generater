<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function create(Request $request, $id){
        $request->validate([
            'language' => 'required|max:50', 
            'level' => 'required', 
        ]);


        $language = Language::create([
            'language' => $request->input('language'),
            'level' => $request->input('level'),
            'person_id' => $id
        ]);
        return [
            'language' => $language,
            'message' => "Language createde successfully..."
                
        ];
    }


    public function update(Request $request, $id){
        $request->validate([
            'language' => 'required|max:50', 
            'level' => 'required', 
        ]);


        Language::find($id)->update([
            'language' => $request->input('language'),
            'level' => $request->input('level'),
        ]);

        return [
            'message' => 'language updated successfully...',
            'language' => Language::query()->find($id) 
                
        ];
    }



    public function get($id){
        $language = Language::query()->findOrFail($id);
        return ['language' => $language];
    }


    public function delete($id)
    {
        Language::query()->find($id)->delete();
        return ['message' => 'Language deleted successfully...'];
    }
}
