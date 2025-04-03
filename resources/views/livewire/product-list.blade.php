<div>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h1 class="text-3xl font-bold tracking-tight">Our Collection</h1>
            <div class="w-full md:w-1/3 relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.3-4.3"/>
                </svg>
                <input
                    wire:model.debounce.300ms="search"
                    type="text"
                    placeholder="Search products..."
                    class="w-full pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background"
                >
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="group bg-card rounded-lg overflow-hidden border hover:shadow-md transition-all duration-300">
                    <div class="aspect-square overflow-hidden bg-muted">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <h3 class="font-medium text-lg mb-2 line-clamp-1">{{ $product->name }}</h3>
                        <p class="text-muted-foreground text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">${{ number_format($product->price, 2) }}</span>
                            <button
                                wire:click="addToCart({{ $product->id }})"
                                class="bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-search text-muted-foreground mb-4">
                        <path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/>
                        <path d="m7.5 4.27 9 5.15"/>
                        <polyline points="3.29 7 12 12 20.71 7"/>
                        <line x1="12" x2="12" y1="22" y2="12"/>
                        <circle cx="18.5" cy="15.5" r="2.5"/>
                        <path d="M20.27 17.27 22 19"/>
                    </svg>
                    <p class="text-muted-foreground text-lg">No products found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        window.addEventListener('notify', event => {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-card border shadow-lg rounded-lg p-4 max-w-md z-50 animate-in fade-in slide-in-from-bottom-5';
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
