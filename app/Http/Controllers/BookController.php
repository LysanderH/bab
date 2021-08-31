<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Bac;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Rules\ISBN;
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

        $request->session()->flash('success', 'Le livre à bien été ajouté.');

        return redirect(route('admin.book.index', ['book' => $book->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.book.show', ['book' => Book::where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.book.edit', [
            'book' => Book::where('id', $id)->first(),
            'categories' => Category::all(),
            'bacs' => Bac::all(),
        ]);
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
        $validated = $request->validate(
            [
                'ISBN' => ['required', 'min:3', 'max:256', new ISBN],
                'title' => 'required|min:3|max:256',
                'author' => 'required|min:3|max:256',
                'cover' => 'image|mimes:jpeg,png,jpg',
                'stock' => 'required|min:0|max:10000|numeric',
                'price' => 'required|min:0|max:10000|numeric',
                'category' => 'required',
                'bac' => 'required',
                'excerpt' => 'required',
                'bac' => 'required',
            ]
        );
        if (key_exists('cover', $validated)) {
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
            }
        }

        $book = Book::where('id', $book->id)->update([
            'ISBN' => $validated['ISBN'],
            'title' => $validated['title'],
            'author' => $validated['author'],
            'cover' => $coverName ?? $book->cover,
            'stock' => $validated['stock'],
            'price' => $validated['price'],
            'category_id' => $validated['category'],
            'bac_id' => $validated['bac'],
            'excerpt' => $validated['excerpt'],
        ]);

        $request->session()->flash('success', 'Le livre à bien été modifié.');

        return redirect(route('admin.book.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        Book::destroy($book->id);

        $request->session()->flash('success', 'Le livre à bien été supprimé.');

        return redirect()->back();
    }
}
