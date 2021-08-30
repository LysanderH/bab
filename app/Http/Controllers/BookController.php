<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Bac;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Image;

use function PHPUnit\Framework\fileExists;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.book.create', [
            'categories' => Category::all(),
            'bacs' => Bac::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create([
            'ISBN' => $validated['ISBN'],
            'title' => $validated['title'],
            'author' => $validated['author'],
            'cover' => $validated['cover'],
            'stock' => $validated['stock'],
            'price' => $validated['price'],
            'category_id' => $validated['category'],
            'bac_id' => $validated['bac'],
            'excerpt' => $validated['excerpt'],
        ]);

        if (fileExists($validated['cover'])) {
            $image = $validated['cover'];

            $destinationPath = public_path('/storage/covers');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }

            $imgFile = Image::make($image->getRealPath());
            $smallCover = Image::make($image->getRealPath());

            $coverName = $book->id . '_cover' . time() . '.jpg';

            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath . '/' . $coverName);
            $smallCover->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath . '/small_' . $coverName);

            $book->update([
                'cover' => $coverName,
            ]);
        }

        return redirect(route('admin.book.show', ['book' => $book->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
