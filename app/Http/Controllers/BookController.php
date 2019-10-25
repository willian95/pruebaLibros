<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Book;

class BookController extends Controller
{
    
    function index(){

        $books = Book::all();
        return view('welcome', ['books' => $books]);

    }

    function store(Request $request){

        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'amount' =>'required|integer',
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);

        $book = new Book;
        $book->name = $request->name;
        $book->price = $request->price;
        $book->amount = $request->amount;
        $path = Storage::disk('custom')->put('images/books', $request->file('image'));
        $book->image = $path;
        $book->save();

        return redirect()->back()->with('success', 'Libro creado');

    }

    function delete($id){

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('success', 'Libro eliminado');

    }

    function edit($id){

        $book = Book::find($id);
        return view('edit', ['book' => $book]);

    }

    function update($id, Request $request){

        $this->validate($request, [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'amount' =>'required|numeric'
        ]);

        $book = Book::findOrFail($id);
        $book->name = $request->name;
        $book->price = $request->price;
        $book->amount = $request->amount;

        if($request->has('image')){
            $path = Storage::disk('custom')->put('images/books', $request->file('image'));
            $book->image = $path;
        }

        $book->update();

        return redirect()->to('/')->with('success', 'Libro actualizado');

    }

    
}
