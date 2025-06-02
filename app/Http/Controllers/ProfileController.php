<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    //
    public function show(){
        
    }
    public function update(ProfileRequest $request){
        $user=auth('User')->users;
        $user->update($request->validated());
        if($request->has('image')){
            $user->addMdia($request->file('image'));
            
        }
        
    }
}