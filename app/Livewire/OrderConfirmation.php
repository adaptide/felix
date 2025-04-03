<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderConfirmation extends Component
{
    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.order-confirmation');
    }
}

