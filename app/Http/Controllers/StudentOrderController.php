<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceEmail;
use App\Models\Bac;
use App\Models\Book;
use App\Models\Order;
use App\Models\Period;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StudentOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with('books')->where('user_id', $request->user()->id)->orderByDesc('created_at')->get();
        return view('student.order.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $period = Period::where('active', true)->first();

        if ($period->deadline <= date('Y-m-d H:i:s')) {
            $request->session()->flash('error', 'La date limite est passée.');
            return redirect()->back();
        }
        $selected = session()->get('cart') ? array_map(function ($id) {
            return (int)$id;
        }, session()->get('cart')) : [];

        // dd(session()->get('cart'));


        return view('student.order.create', [
            'bacs' => Bac::with('books', 'books.category')->get(),
            'selected' => $selected,
        ]);
    }

    /**
     * Add a newly created resource in session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $books = [];
        $total = 0;

        $request->validate([
            'book' => 'required|array',
        ]);

        session()->forget('cart');

        foreach ($request->book as $bookId) {
            $book = Book::where('id', (int)$bookId)->first();

            if (!$book) {
                $request->session()->flash('error', 'Veuillez ne pas ajouter de livre inexistant.');
                return redirect()->back();
            }

            array_push($books, $book);
            $total = $total + $book->price;
        }

        session()->put('cart', $request->book);

        return view('student.order.create-two', [
            'books' => $books,
            'total' => $total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|array',
        ]);

        $books = [];
        $total = 0;

        foreach ($request->amount as $bookId => $amount) {
            if ((int)$amount !== 0) {
                $book = Book::where('id', $bookId)->first();

                if (!$book) {
                    $request->session()->flash('error', 'Veuillez ne pas ajouter de livre inexistant.');
                    return redirect()->back();
                }
                $total = $total + ($book->price * $amount);
                array_push($books, $book);
            }
        }

        $order = Order::create([
            'total' => $total,
            'user_id' => $request->user()->id,
            'status_id' => Status::where('name', 'Commandé')->first()->id,
            'period_id' => Period::where('active', true)->first()->id,
        ]);

        foreach ($request->amount as $bookId => $amount) {
            if ((int) $amount > 0) {
                $order->books()->attach($bookId, ['amount' => $amount, 'current_price' => Book::where('id', (int)$bookId)->first()->price]);
            }
        }

        Mail::to($order->user->email)->send(new OrderInvoiceEmail($order));

        session()->forget('cart');

        $request->session()->flash('success', 'La commande a été ajouté.');

        return redirect(route('admin.order.index'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
