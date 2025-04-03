<div>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-3xl font-bold tracking-tight">My Orders</h1>

            <div class="w-full md:w-auto flex flex-col sm:flex-row gap-2">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-search absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                    <input wire:model.live.debounce.250ms="search" type="text" placeholder="Search orders..."
                        class="w-full sm:w-64 pl-10 pr-4 py-2  border rounded-md focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background">
                </div>
            </div>
        </div>

        @if ($orders->isEmpty())
            <div class="bg-card border rounded-lg flex flex-col items-center justify-center py-16 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-package text-muted-foreground mb-4">
                    <path
                        d="m16.5 9.4-9-5.19M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    <polyline points="3.29 7 12 12 20.71 7" />
                    <line x1="12" x2="12" y1="22" y2="12" />
                </svg>
                <p class="text-muted-foreground text-lg mb-6">You haven't placed any orders yet.</p>
                <a href="{{ route('products') }}"
                    class="bg-primary text-primary-foreground hover:bg-primary/90 px-6 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="bg-card border rounded-lg overflow-hidden mt-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="px-6 py-4 text-left font-medium py-2">
                                    <button wire:click="sortBy('id')"
                                        class="flex items-center gap-1 hover:text-primary transition-colors duration-200">
                                        Order ID
                                        @if ($sortField === 'id')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide {{ $sortDirection === 'asc' ? 'lucide-chevron-up' : 'lucide-chevron-down' }}">
                                                @if ($sortDirection === 'asc')
                                                    <path d="m18 15-6-6-6 6" />
                                                @else
                                                    <path d="m6 9 6 6 6-6" />
                                                @endif
                                            </svg>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-4 text-left font-medium">
                                    <button wire:click="sortBy('created_at')"
                                        class="flex items-center gap-1 hover:text-primary transition-colors duration-200">
                                        Product
                                        @if ($sortField === 'created_at')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide {{ $sortDirection === 'asc' ? 'lucide-chevron-up' : 'lucide-chevron-down' }}">
                                                @if ($sortDirection === 'asc')
                                                    <path d="m18 15-6-6-6 6" />
                                                @else
                                                    <path d="m6 9 6 6 6-6" />
                                                @endif
                                            </svg>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-4 text-left font-medium">
                                    <button wire:click="sortBy('created_at')"
                                        class="flex items-center gap-1 hover:text-primary transition-colors duration-200">
                                        Date
                                        @if ($sortField === 'created_at')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide {{ $sortDirection === 'asc' ? 'lucide-chevron-up' : 'lucide-chevron-down' }}">
                                                @if ($sortDirection === 'asc')
                                                    <path d="m18 15-6-6-6 6" />
                                                @else
                                                    <path d="m6 9 6 6 6-6" />
                                                @endif
                                            </svg>
                                        @endif
                                    </button>
                                </th>

                                <th class="px-6 py-4 text-left font-medium">
                                    <button wire:click="sortBy('status')"
                                        class="flex items-center gap-1 hover:text-primary transition-colors duration-200">
                                        Status
                                        @if ($sortField === 'status')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide {{ $sortDirection === 'asc' ? 'lucide-chevron-up' : 'lucide-chevron-down' }}">
                                                @if ($sortDirection === 'asc')
                                                    <path d="m18 15-6-6-6 6" />
                                                @else
                                                    <path d="m6 9 6 6 6-6" />
                                                @endif
                                            </svg>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-4 text-left font-medium">
                                    <button wire:click="sortBy('total_amount')"
                                        class="flex items-center gap-1 hover:text-primary transition-colors duration-200">
                                        Total
                                        @if ($sortField === 'total_amount')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide {{ $sortDirection === 'asc' ? 'lucide-chevron-up' : 'lucide-chevron-down' }}">
                                                @if ($sortDirection === 'asc')
                                                    <path d="m18 15-6-6-6 6" />
                                                @else
                                                    <path d="m6 9 6 6 6-6" />
                                                @endif
                                            </svg>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-4 text-right font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($orders as $order)
                                <tr class="hover:bg-muted/50 transition-colors duration-200 ">
                                    <td class="px-6 py-3 font-medium">#{{ $order->id }}</td>
                                    <td class="px-6 py-3 text-muted-foreground">
                                        {{ $order->items->first()->product->name }}</td>
                                    <td class="px-6 py-3 text-muted-foreground">
                                        {{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-3">
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                            @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif ($order->status === 'processing') bg-blue-100 text-blue-800
                                            @elseif ($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                            @elseif ($order->status === 'delivered') bg-green-100 text-green-800
                                            @elseif ($order->status === 'cancelled') bg-red-100 text-red-800 @endif
                                        ">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium">${{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('orders.show', $order) }}"
                                            class="text-primary hover:text-primary/80 font-medium text-sm transition-colors duration-200">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
