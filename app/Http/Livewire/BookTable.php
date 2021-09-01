<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Period;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class BookTable extends Component
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
        // foreach ($books as $book) {
        //     dd($book->orders->whereHas('period', function (Builder $query) {
        //         $query->where('active' == true);
        //     }))->sum('amount');
        // }
        return view('livewire.book-table', [
            'books' => Book::with('orders.period')->when($this->term, function ($query, $term) {
                return $query->where('title', 'LIKE', "%$term%")->orWhere('author', 'LIKE', "%$term%");
            })->when($this->sortBy, function ($query, $sortBy) {
                return $query->orderBy($sortBy, $this->sortDirection);
            })->paginate($this->perPage),
        ]);
    }
}
