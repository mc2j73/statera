<?php

namespace App\Http\Controllers;

use App\Models\Character; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacterController extends Controller
{
	public function __construct()
    {
        $this->middleware('has_character');
    }

    public function create()
    {

    	return view('character.create');
    }

    public function store(Request $request)
    {
    	Validator::make($request->all(), [
    	    'name' => 'required|string|alpha_dash|min:6|max:32|unique:characters'
   		])->validate();

    	Character::create([
    		'name' => $request->get('name'),
    		'user_id' => \Auth::user()->id
    	]);

    	return redirect(route('home'))->with('succes', 'Character created');
	}
}
