<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage(){

        $ourName = 'brad';
        $animals = ['Meosalot', 'Barksalot', 'Purssloud', 'wakwak', 'kikik', 'do you love me'];

        return view('homepage', ['allAnimals'=>$animals, 'name'=>$ourName, 'catname'=>'Meowsalot']);
    }

    public function about(){
        return view('single-post');
    }
}
