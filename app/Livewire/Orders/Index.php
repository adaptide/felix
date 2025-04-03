<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'status', 'sortField', 'sortDirection'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::with(['items', 'items.product'])
            ->where('user_id', auth()->id())
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                        ->orWhere('shipping_name', 'like', '%' . $this->search . '%')
                        ->orWhere('shipping_email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.orders.index', [
            'orders' => $orders,
        ]);
    }
}
