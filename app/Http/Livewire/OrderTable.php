<?php

namespace App\Http\Livewire;

use App\Mail\OrderReadyEmail;
use App\Models\Book;
use App\Models\Order;
use App\Models\Period;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{
    use WithPagination;

    public $term = '';
    public $perPage = 25;
    public $sortBy = 'title';
    public $sortDirection = 'asc';

    protected $queryString = [
        'term' => ['except' => ''],
        'sortBy' => ['except' => ''],
        'sortDirection',
        'perPage',
    ];

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function changeStatus($orderId, $statusId)
    {
        $order = Order::with('books', 'user')->where('id', (int)$orderId)->first();
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
        $orders = Order::with('books', 'user', 'status')->when($this->term, function ($query, $term) {
            return $query->whereHas('user', function (Builder $query) use ($term) {
                $query->where('name', 'LIKE', "%$term%");
            });
        })->paginate($this->perPage);

        $statuses = Status::all();

        return view('livewire.order-table', [
            'orders' => $orders,
            'statuses' => $statuses,
        ]);
    }
}
