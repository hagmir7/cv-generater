<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function create($slug){
        $personel = Personal::where('slug', '=', $slug)->get();

        
        if(count($personel) == 0){
            throw new ModelNotFoundException();
        }else{
            $personel = $personel[0];
        }

        return view('create',[
            'slug' => $slug,
            'personel' => $personel,
            'experiences' => $personel->experience,
            'diplomes' => $personel->diplome,
            'hobbies' => $personel->hobby,
            'languages' => $personel->language,
            'qualities' => $personel->quality,
            'skills' => $personel->skill
        ]);
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpg,png,jpeg,gif',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'city' => 'required|max:50',
            'address' => 'required|max:60',
            'cin' => 'required|max:20',
            'phone' => 'required|max:20',
            'zip' => 'required|max:20',
            'job' => 'required|max:30',
            'bio' => 'required|max:160'

        ]);

        $personel = Personal::query()->findOrFail($id);
        $personel->update([
            // 'avatar' => $request->input('avatar'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'cin' => $request->input('cin'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
            'job' => $request->input('job'),
            'bio' => $request->input('bio')
            
        ]);

        
        if($request->file('avatar')){
            $file = $request->file('avatar');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/Image'), $filename);
            $personel['avatar']= $filename;
        }
        $personel->save();
    }


    public function autoCreate(){
        $slug = date('YmdHi');
        Personal::query()->create([
            'slug' => $slug,
            'user_id' => 1
        ]);
        return redirect()->route('cv.create', $slug);
    }



    public function delete($id){
        Personal::query()->find($id)->delete();
    return redirect('/');

    }




    public function getCv($id){
        $cv = Personal::query()->find($id);

        // return view('pdf', [
        //     'cv' => $cv
        // ]);

        // $pdf = Pdf::loadView('pdf', [
        //     'cv' => $cv
        // ]);
        // Pdf::setOption(['dpi' => 150, 'defaultFont' => 'source sans pro']);
        // return $pdf->download($cv->first_name.'_'.$cv->last_name.'.pdf');

    }
}

