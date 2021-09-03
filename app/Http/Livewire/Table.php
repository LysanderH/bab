<?php

namespace App\Http\Livewire;

use App\Mail\OrderReadyEmail;
use App\Models\Book;
use App\Models\Order;
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
        return view('livewire.table', [
            'orders' => Order::with('user', 'status')->paginate(10),
            'statuses' => Status::all(),
        ]);
    }
}
