<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(3);

        return view('books.index',compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /*request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);*/


        $book = new Book;
        $book->titulo = $request->titulo;
        $book->autores = $request->autores;
        $book->descripcion = $request->descripcion;

       
        $book->save();

        $caratula = $request->file('caratula');
        $tmp_caratula_name = $book->id.'_'.date('Ymdhis').'.'.$caratula->getClientOriginalExtension();

        if ($caratula->isValid()) {

            $caratula->move(public_path('images'), $tmp_caratula_name);
        }
        
        $archivo = $request->file('archivo'); 
        $tmp_archivo_name = $book->id.'_'.date('Ymdhis').'.'.$archivo->getClientOriginalExtension();

        if ($archivo->isValid()) {
            
            $archivo->move(public_path('pdfs'), $tmp_archivo_name);
        }

        $book = Book::findOrFail($book->id);

        $book->caratula = $tmp_caratula_name;
        $book->archivo = $tmp_archivo_name;
        $book->save();







        return redirect()->route('books.index')
                        ->with('success','Se ha creado el nuevo recurso satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //echo "AQUI"; exit;
        /*request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);*/


        $book->update($request->all());
        
        $caratula = $request->file('caratula');
        $tmp_caratula_name = $book->archivo;
        
        if ($caratula != null && $caratula->isValid()) {
            $tmp_caratula_name = $book->id.'_'.date('Ymdhis').'.'.$caratula->getClientOriginalExtension();
            $caratula->move(public_path('images'), $tmp_caratula_name);
        }
        
        $archivo = $request->file('archivo'); 
        
        $tmp_archivo_name = $book->archivo;
        if ($archivo != null && $archivo->isValid()) {
            $tmp_archivo_name = $book->id.'_'.date('Ymdhis').'.'.$archivo->getClientOriginalExtension();
            $archivo->move(public_path('pdfs'), $tmp_archivo_name);
        }

        $book = Book::findOrFail($book->id);
        $book->caratula = $tmp_caratula_name;
        $book->archivo = $tmp_archivo_name;

        $book->save();
        

        return redirect()->route('books.index')
                        ->with('success','Actualizado Correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo "ELIMINAR"; exit;
        $book = Book::findOrFail($id);
        $book->delete();


        return redirect()->route('books.index')
                        ->with('success','Book deleted.');
    }
}
