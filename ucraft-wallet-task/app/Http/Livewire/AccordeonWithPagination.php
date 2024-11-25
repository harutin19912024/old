<?php

namespace App\Http\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AccordeonWithPagination extends Component
{
    use WithPagination;

    public $items;

    public $perPage;

    public function mount($items, $perPage = null)
    {
        $this->items = is_array($items) ? collect($items) : $items;
        $this->perPage = $perPage ?: 12;
    }

    public function render()
    {
        $items = $this->items->forPage($this->page, $this->perPage);

        $paginator = new LengthAwarePaginator($items, $this->items->count(), $this->perPage, $this->page);

        return view('livewire.accordeon-with-pagination', ['paginator' => $paginator]);
    }
}
