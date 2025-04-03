<div>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <a href="{{ route('orders') }}" class="text-muted-foreground hover:text-foreground transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left">
                            <path d="m12 19-7-7 7-7"/>
                            <path d="M19 12H5"/>
                        </svg>
                    </a>
                    <h1 class="text-3xl font-bold tracking-tight">Order #{{ $order->id }}</h1>
                </div>
                <p class="text-muted-foreground mt-3">Placed on {{ $order->created_at->format('F j, Y') }}</p>
            </div>

            <span class="inline-flex items-center rounded-full px-3 text-sm font-medium
                @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif ($order->status === 'processing') bg-blue-100 text-blue-800
                @elseif ($order->status === 'shipped') bg-indigo-100 text-indigo-800
                @elseif ($order->status === 'delivered') bg-green-100 text-green-800
                @elseif ($order->status === 'cancelled') bg-red-100 text-red-800
                @endif
            ">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-card border rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-lg font-semibold">Order Items</h2>
                    </div>

                    <div class="divide-y">
                        @foreach ($order->items as $item)
                            <div class="p-6 flex items-center gap-4">
                                <div class="w-16 h-16 rounded-md overflow-hidden bg-muted flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium">{{ $item->product->name }}</h4>
                                    <div class="flex justify-between text-sm text-muted-foreground">
                                        <span>${{ number_format($item->price, 2) }} × {{ $item->quantity }}</span>
                                        <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    <div class="bg-card border rounded-lg p-6">
                        <h2 class="text-lg font-semibold mb-4">Shipping Information</h2>
                        <div class="space-y-2 text-muted-foreground">
                            <p class="font-medium text-foreground">{{ $order->shipping_name }}</p>
                            <p>{{ $order->shipping_address }}</p>
                            <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                            <p>{{ $order->shipping_email }}</p>
                        </div>
                    </div>

                    <div class="bg-card border rounded-lg p-6">
                        <h2 class="text-lg font-semibold mb-4">Payment Information</h2>
                        <div class="space-y-2 text-muted-foreground">
                            <p>
                                <span class="font-medium text-foreground">Method:</span>
                                {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                            </p>
                            <p>
                                <span class="font-medium text-foreground">Status:</span>
                                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Paid</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-card border rounded-lg p-6 sticky top-6">
                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-muted-foreground">Subtotal</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-muted-foreground">Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-muted-foreground">Tax</span>
                            <span>$0.00</span>
                        </div>
                        <div class="flex justify-between font-medium text-lg pt-2 border-t">
                            <span>Total</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    @if ($order->status === 'pending' || $order->status === 'processing')
                        <div class="mt-6 pt-4 border-t">
                            <button
                                class="w-full bg-destructive text-destructive-foreground hover:bg-destructive/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                            >
                                Cancel Order
                            </button>
                        </div>
                    @endif

                    @if ($order->status === 'shipped')
                        <div class="mt-6 pt-4 border-t">
                            <button
                                class="w-full bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                            >
                                Track Shipment
                            </button>
                        </div>
                    @endif

                    @if ($order->status === 'delivered')
                        <div class="mt-6 pt-4 border-t">
                            <button
                                class="w-full bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                            >
                                Write a Review
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

