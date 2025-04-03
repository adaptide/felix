<?php

namespace App\Livewire;

use Livewire\Component;

class ShoppingCart extends Component
{
    public $cartItems = [];

    protected $listeners = ['cartUpdated' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->cartItems = session()->get('cart', []);
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $this->updateCart();
            $this->dispatch('cartUpdated');
            session()->flash('notify', 'Product removed from cart!');
        }
    }

    public function increaseQuantity($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
            $this->updateCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function decreaseQuantity($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                unset($cart[$productId]);
            }

            session()->put('cart', $cart);
            $this->updateCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->updateCart();
        $this->dispatch('cartUpdated');
        session()->flash('notify', 'Cart cleared');
    }

    public function checkout()
    {
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
