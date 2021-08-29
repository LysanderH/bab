<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Status;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.table', [
            'orders' => Order::with('user', 'status')->paginate(10),
            'status' => Status::all(),
        ]);
    }
}
