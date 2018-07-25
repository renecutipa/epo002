<?php

namespace App\Http\Controllers;

use View;
use DB;
use App\Book;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function index(Request $request)
    {
        $books = Book::all()->take(6);

        $queryWord = strtoupper($request->q);
        $searchedBooks = null;
        if($queryWord != ""){
        	$searchedBooks = Book::where('titulo', 'like', DB::raw('upper('.'"%'.$queryWord.'%")'))
        	->get();
        }
        View::share('q', $request->q);
        View::share('searchedBooks', $searchedBooks );
        return view('welcome',compact('books'));


        
    }
}
