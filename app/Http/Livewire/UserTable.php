<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $term;

    public function render()
    {
        return view('livewire.user-table', [
            'users' => User::when($this->term, function ($query, $term) {
                return $query->where('name', 'LIKE', "%$term%");
            })->paginate(20),
        ]);
    }
}
