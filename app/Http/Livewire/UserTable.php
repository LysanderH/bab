<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $term = '';
    public $perPage = 25;
    public $sortBy = 'name';
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
        return view('livewire.user-table', [
            'users' => User::when($this->term, function ($query, $term) {
                return $query->where('name', 'LIKE', "%$term%");
            })->when($this->sortBy, function ($query, $sortBy) {
                return $query->orderBy($sortBy, $this->sortDirection);
            })->paginate($this->perPage),
        ]);
    }
}
