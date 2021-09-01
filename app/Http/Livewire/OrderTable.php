<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Period;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
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
