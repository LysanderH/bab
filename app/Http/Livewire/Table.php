<?php

namespace App\Http\Livewire;

use App\Mail\OrderReadyEmail;
use App\Models\Book;
use App\Models\Order;
use App\Models\Period;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Table extends Component
{
    public function changeStatus($orderId, $statusId)
    {
        $order = Order::with('books', 'user')->where('id', (int)$orderId)->orderByDesc('created_at')->first();
        $status = Status::where('id', (int)$statusId)->first();

        $order->update([
            'status_id' => $status->id
        ]);

        if ($status->id == 3) {
            Mail::to($order->user->email)->send(new OrderReadyEmail($order));
        }

        if ($status->id == 4) {
            foreach ($order->books as $book) {
                Book::where('id', $book->id)->first()->update([
                    'stock' => $book->stock - $book->pivot->amount,
                ]);
            }
        }

        session()->flash('message', 'La commande a été modifié.');
    }

    public function render()
    {
        $period = Period::with('orders.user', 'orders.status')->where('active', true)->first();

        if ($period) {
            $orders = $period->orders()->orderByDesc('created_at')->paginate(25);
        } else {
            $orders = Order::with('user', 'status')->orderByDesc('created_at')->get();
        }

        return view('livewire.table', [
            'orders' => $orders,
            'statuses' => Status::all(),
        ]);
    }
}
