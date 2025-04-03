<div>
    <div class="max-w-3xl mx-auto space-y-8 py-8">
        <div class="bg-card border rounded-lg p-8 text-center">
            <div class="mb-6 mt-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-check">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold tracking-tight">Order Confirmed!</h1>
                <p class="text-muted-foreground mt-2">Thank you for your purchase.</p>
            </div>

            <div class="flex justify-center mt-8 mb-6">
                <a href="{{ route('products') }}"
                    class="bg-primary p-6 text-primary-foreground hover:bg-primary/90 px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Continue Shopping
                </a>
            </div>
        </div>

        <div class="bg-card border rounded-lg p-6 mt-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Order #{{ $order->id }}</h2>
                <span class="text-sm text-muted-foreground">{{ $order->created_at->format('F j, Y') }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-muted-foreground uppercase mb-3">Shipping Information</h3>
                    <div class="bg-muted/50 rounded-md p-4 space-y-1">
                        <p class="font-medium">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                        <p>{{ $order->shipping_email }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-muted-foreground uppercase mb-3">Payment Information</h3>
                    <div class="bg-muted/50 rounded-md p-4 space-y-1">
                        <p class="font-medium">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                        <p>Status: <span
                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Paid</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-sm font-medium text-muted-foreground uppercase mb-3">Order Items</h3>
                <div class="bg-muted/50 rounded-md overflow-hidden">
                    <div class="divide-y">
                        @foreach ($order->items as $item)
                            <div class="p-4 flex items-center gap-4">
                                <div class="w-16 h-16 rounded-md overflow-hidden bg-muted flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item->product?->image) }}"
                                        alt="{{ $item->product?->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium truncate">{{ $item->product?->name }}</h4>
                                    <div class="flex justify-between text-sm text-muted-foreground">
                                        <span>${{ number_format($item->price, 2) }} × {{ $item->quantity }}</span>
                                        <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4 bg-card border-t">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-muted-foreground">Subtotal</span>
                                <span>${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-muted-foreground">Shipping</span>
                                <span>Free</span>
                            </div>
                            <div class="flex justify-between font-medium text-lg pt-2 border-t">
                                <span>Total</span>
                                <span>${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
