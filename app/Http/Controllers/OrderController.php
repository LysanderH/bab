<?php

namespace App\Http\Controllers;

use App\Mail\OrderReadyEmail;
use App\Models\Book;
use App\Models\Order;
use App\Models\Period;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create', [
            'users' => User::all(),
            'books' => Book::all(),
            'statuses' => Status::all(),
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
        $amountArray = $request->amount;
        $total = 0;

        foreach ($amountArray as $key => $amount) {
            if ((int) $amount > 0) {
                $total = $total + (Book::where('id', (int)$key)->first()->price * $amount);
            }
        }

        $order = Order::create([
            'total' => $total,
            'user_id' => $request->user,
            'status_id' => $request->status,
            'period_id' => Period::where('active', true)->first()->id,
        ]);

        foreach ($amountArray as $key => $amount) {
            if ((int) $amount > 0) {
                $order->books()->attach($key, ['amount' => $amount, 'current_price' => Book::where('id', (int)$key)->first()->price]);
            }
        }

        if ($request->status == 3) {
            Mail::to($order->user->email)->send(new OrderReadyEmail($order));
        }

        if ($request->status == 4) {
            foreach ($order->books as $book) {
                Book::where('id', $book->id)->first()->update([
                    'stock' => $book->stock - $book->pivot->amount,
                ]);
            }
        }

        $request->session()->flash('success', 'La commande a été ajouté.');

        return redirect(route('admin.order.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order.show', [
            'order' => Order::with('user', 'status')->where('id', $order->id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.order.edit', [
            'order' => Order::with('user', 'status', 'books')->where('id', $order->id)->first(),
            'users' => User::all(),
            'books' => Book::all(),
            'statuses' => Status::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $amountArray = $request->amount;
        $total = 0;

        foreach ($amountArray as $key => $amount) {
            if ((int) $amount > 0) {
                $total = $total + (Book::where('id', (int)$key)->first()->price * $amount);
            }
        }

        Order::where('id', $order->id)->update([
            'total' => $total,
            'user_id' => $request->user,
            'status_id' => $request->status,
            'period_id' => Period::where('active', true)->first()->id,
        ]);

        foreach ($order->books as $book) {
            $order->books()->detach($book->id);
        }

        foreach ($amountArray as $key => $amount) {
            if ((int) $amount > 0) {
                $order->books()->attach($key, ['amount' => $amount, 'current_price' => Book::where('id', (int)$key)->first()->price]);
            }
        }

        if ($request->status == 3) {
            Mail::to($order->user->email)->send(new OrderReadyEmail($order));
        }

        if ($request->status == 4) {
            foreach ($order->books as $book) {
                Book::where('id', $book->id)->first()->update([
                    'stock' => $book->stock - $book->pivot->amount,
                ]);
            }
        }

        $request->session()->flash('success', 'La commande a été modifié.');

        return redirect(route('admin.order.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Request $request)
    {
        Order::destroy($order->id);

        $request->session()->flash('success', 'La commande a bien été supprimé.');

        return redirect()->back();
    }
}
