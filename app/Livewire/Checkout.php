<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class Checkout extends Component
{
    public $cartItems = [];
    public $total = 0;

    public $name;
    public $email;
    public $address;
    public $city;
    public $state;
    public $zipCode;
    public $paymentMethod = 'credit_card';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required',
        'address' => 'required|min:5',
        'city' => 'required',
        'state' => 'required',
        'zipCode' => 'required',
        'paymentMethod' => 'required',
    ];

    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $this->name = $user->name;
            $this->email = $user->email;
        }

        $this->cartItems = session()->get('cart', []);

        if (empty($this->cartItems)) {
            return redirect()->route('products');
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        foreach ($this->cartItems as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
    }

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $this->total,
            'status' => 'pending',
            'shipping_name' => $this->name,
            'shipping_email' => $this->email,
            'shipping_address' => $this->address,
            'shipping_city' => $this->city,
            'shipping_state' => $this->state,
            'shipping_zip' => $this->zipCode,
            'payment_method' => $this->paymentMethod,
        ]);

        foreach ($this->cartItems as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.confirmation', $order->id);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}

