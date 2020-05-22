<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book;
use \App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\DB;
use \App\Category;

class AdminBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books= DB::table('books')->paginate();
        $categories= DB::table('categories')->paginate();
        return view('manager.booksList', ["books"=>$books ,"categories"=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name','id')->toArray();
        return view ('manager.newBook',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //store
         $book=new book;
         $book->title=$request->title;
         $book->amount=$request->amount;
         $book->author=$request->author;
         $book->price=$request->price;
         $book->cate_id=$request->cate_id;
         $book->description=$request->description;
         // first request img then give parameters to store 
         $book->book_img=$request->book_img->store('images','public');        
         
        //>>> uploading images to right place and saving imgs in db by name or date made by Anis >>>
         // upload img to path , assign the img request to real file, then get name as date upload
         if ($files = $request->file('book_img')) {
             $destinationPath = 'images/'; 
             $bookImage = $files->getClientOriginalName();
             $files->move($destinationPath, $bookImage);
             $book->book_img=$bookImage;  // assign img to book
         }
 
         $book->save();
 // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>.
         
        return redirect('/adminBooks');
         
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books=Book::findOrFail($id);
        $categories = Category::all()->pluck('name','id')->toArray();
        return view ('manager.bookEdit',["books"=>$books ,"categories"=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book=Book::find($id);
        $book->title=$request->title;
        $book->amount=$request->amount;
        $book->author=$request->author;
        $book->price=$request->price;
        $book->cate_id=$request->cate_id;
        $book->description=$request->description;
        // first request img then give parameters to store 
        $book->book_img=$request->book_img->store('images','public');        
        
        // upload img to path , assign the img request to real file, then get name as date upload
        if ($files = $request->file('book_img')) {
            $destinationPath = 'images/'; 
            $bookImage = $files->getClientOriginalName();
            $files->move($destinationPath, $bookImage);
            $book->book_img=$bookImage;  // assign img to book
        }

        $book->save();
        return redirect('/adminBooks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::find($id);
        $book->delete();
        return redirect('/adminBooks');
    }
}
