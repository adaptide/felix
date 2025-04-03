<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        // Ensure the user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.orders.show');
    }
}

