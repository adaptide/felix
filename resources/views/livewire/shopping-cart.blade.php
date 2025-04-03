<div>
    <div class="space-y-6">
        <h1 class="text-3xl font-bold tracking-tight">Shopping Cart</h1>
        @if (!empty($cartItems) && count($cartItems) != 0)
            <div class="bg-card border rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="px-6 py-4 text-left font-medium">Product</th>
                                <th class="px-6 py-4 text-left font-medium">Price</th>
                                <th class="px-6 py-4 text-left font-medium">Quantity</th>
                                <th class="px-6 py-4 text-left font-medium">Subtotal</th>
                                <th class="px-6 py-4 text-left font-medium sr-only">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($cartItems as $id => $item)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 rounded-md overflow-hidden bg-muted">
                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                    alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                            </div>
                                            <span class="font-medium">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">${{ number_format($item['price'], 2) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center border rounded-md w-fit">
                                            <button wire:click="decreaseQuantity({{ $id }})"
                                                class="px-3 py-1 hover:bg-muted transition-colors duration-200">-</button>
                                            <span class="px-4 py-1 border-x">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQuantity({{ $id }})"
                                                class="px-3 py-1 hover:bg-muted transition-colors duration-200">+</button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td class="px-6 py-4">
                                        <button wire:click="removeItem({{ $id }})"
                                            class="text-destructive hover:text-destructive/80 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash-2">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                <line x1="10" x2="10" y1="11" y2="17" />
                                                <line x1="14" x2="14" y1="11" y2="17" />
                                            </svg>
                                            <span class="sr-only">Remove</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6">
                <div class="flex flex-col gap-2">
                    <div class="text-lg font-medium">Order Summary</div>
                    <div class="flex justify-between text-muted-foreground">
                        <span>Subtotal</span>
                        <span>${{ number_format(
                            array_sum(
                                array_map(function ($item) {
                                    return $item['price'] * $item['quantity'];
                                }, $cartItems),
                            ),
                            2,
                        ) }}</span>
                    </div>
                    <div class="flex justify-between text-muted-foreground">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="flex justify-between font-medium text-lg pt-2 border-t">
                        <span>Total</span>
                        <span>${{ number_format(
                            array_sum(
                                array_map(function ($item) {
                                    return $item['price'] * $item['quantity'];
                                }, $cartItems),
                            ),
                            2,
                        ) }}</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button wire:click="clearCart"
                        class="bg-destructive text-destructive-foreground hover:bg-destructive/90 px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Clear Cart
                    </button>

                    <button wire:click="checkout"
                        class="bg-primary text-primary-foreground hover:bg-primary/90 px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        @else
            <div class="bg-card border rounded-lg flex flex-col items-center justify-center py-16 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shopping-cart text-muted-foreground mb-4">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>
                <p class="text-muted-foreground text-lg mb-6">Your cart is empty.</p>
                <a href="{{ route('products') }}"
                    class="bg-primary text-primary-foreground hover:bg-primary/90 px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>

    <script>
        window.addEventListener('notify', event => {
            // Create toast notification
            const toast = document.createElement('div');
            toast.className =
                'fixed bottom-4 right-4 bg-card border shadow-lg rounded-lg p-4 max-w-md z-50 animate-in fade-in slide-in-from-bottom-5';
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle text-green-500">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    <span>${event.detail.message}</span>
                </div>
            `;
            document.body.appendChild(toast);

            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('animate-out', 'fade-out', 'slide-out-to-bottom-5');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        });
    </script>
</div>
