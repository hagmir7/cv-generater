<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function create(Request $request, $id){
        $request->validate([
            'hobby' => 'required|max:50', 
        ]);


        $hobby = Hobby::create([
            'hobby' => $request->input('hobby'),
            'person_id' => $id
        ]);
        return [
            'hobby' => $hobby,
            'message' => "Hobby Created successfully..."
        ];
    }


    public function update(Request $request, $id){
        $request->validate([
            'hobby' => 'required|max:50', 
        ]);


        Hobby::find($id)->update([
            'hobby' => $request->input('hobby'),
        ]);

        return [
            'message' => 'hobby updated successfully...',
            'hobby' => Hobby::query()->find($id) 
                
        ];
    }



    public function get($id){
        $hobby = Hobby::query()->findOrFail($id);
        return ['hobby' => $hobby];
    }


    public function delete($id)
    {
        Hobby::query()->find($id)->delete();
        return ['message' => 'hobby deleted successfully...'];
    }
}
