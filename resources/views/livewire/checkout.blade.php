<div>
    <div class="space-y-6">
        <h1 class="text-3xl font-bold tracking-tight">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-card border rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>

                    <form wire:submit="placeOrder" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-medium">Full Name</label>
                                <input wire:model="name" type="text" id="name"
                                    class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('name') border-destructive @enderror">
                                @error('name')
                                    <span class="text-destructive text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium">Email Address</label>
                                <input wire:model="email" type="email" id="email"
                                    class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('email') border-destructive @enderror">
                                @error('email')
                                    <span class="text-destructive text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="address" class="text-sm font-medium">Address</label>
                            <input wire:model="address" type="text" id="address"
                                class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('address') border-destructive @enderror">
                            @error('address')
                                <span class="text-destructive text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label for="city" class="text-sm font-medium">City</label>
                                <input wire:model="city" type="text" id="city"
                                    class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('city') border-destructive @enderror">
                                @error('city')
                                    <span class="text-destructive text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="state" class="text-sm font-medium">State</label>
                                <input wire:model="state" type="text" id="state"
                                    class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('state') border-destructive @enderror">
                                @error('state')
                                    <span class="text-destructive text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="zipCode" class="text-sm font-medium">ZIP Code</label>
                                <input wire:model="zipCode" type="text" id="zipCode"
                                    class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('zipCode') border-destructive @enderror">
                                @error('zipCode')
                                    <span class="text-destructive text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="bg-card border rounded-lg p-6">
                            <h2 class="text-xl font-semibold mb-4">Payment Method</h2>

                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <input wire:model="paymentMethod" type="radio" id="credit_card"
                                        value="credit_card"
                                        class="h-4 w-4 border-input text-primary focus:ring-primary">
                                    <label for="credit_card" class="text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-credit-card">
                                                <rect width="20" height="14" x="2" y="5" rx="2" />
                                                <line x1="2" x2="22" y1="10" y2="10" />
                                            </svg>
                                            Credit Card
                                        </div>
                                    </label>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <input wire:model="paymentMethod" type="radio" id="paypal" value="paypal"
                                        class="h-4 w-4 border-input text-primary focus:ring-primary">
                                    <label for="paypal" class="text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-paypal">
                                                <path
                                                    d="M7 11.5a2 2 0 0 1-2-2v-1a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H7Z" />
                                                <path
                                                    d="M15.6 15a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1Z" />
                                                <path
                                                    d="M8.5 7v9.5a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1" />
                                            </svg>
                                            PayPal
                                        </div>
                                    </label>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <input wire:model="paymentMethod" type="radio" id="bank_transfer"
                                        value="bank_transfer"
                                        class="h-4 w-4 border-input text-primary focus:ring-primary">
                                    <label for="bank_transfer" class="text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-landmark">
                                                <line x1="3" x2="21" y1="22" y2="22" />
                                                <line x1="6" x2="6" y1="18" y2="11" />
                                                <line x1="10" x2="10" y1="18" y2="11" />
                                                <line x1="14" x2="14" y1="18" y2="11" />
                                                <line x1="18" x2="18" y1="18" y2="11" />
                                                <polygon points="12 2 20 7 4 7" />
                                            </svg>
                                            Bank Transfer
                                        </div>
                                    </label>
                                </div>

                                @error('paymentMethod')
                                    <span class="text-destructive text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary text-primary-foreground hover:bg-primary/90 px-6 py-3 rounded-md text-sm font-medium transition-colors duration-200">
                            Place Order
                        </button>
                    </form>
                </div>


            </div>

            <div>
                <div class="bg-card border rounded-lg p-6 sticky top-6">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

                    <div class="divide-y">
                        @foreach ($cartItems as $item)
                            <div class="py-4 flex items-center gap-4">
                                <div class="w-16 h-16 rounded-md overflow-hidden bg-muted flex-shrink-0">
                                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium truncate">{{ $item['name'] }}</h4>
                                    <div class="flex justify-between text-sm text-muted-foreground">
                                        <span>${{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}</span>
                                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 space-y-2 pt-4 border-t">
                        <div class="flex justify-between text-sm">
                            <span class="text-muted-foreground">Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-muted-foreground">Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="flex justify-between font-medium text-lg pt-2 border-t">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <a href="{{ route('cart') }}"
                            class="inline-flex items-center text-sm text-muted-foreground hover:text-foreground transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left mr-2">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
