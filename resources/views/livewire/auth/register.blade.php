<div>
    <div class="space-y-6">
        <div class="space-y-2 text-center">
            <h1 class="text-2xl font-bold tracking-tight">Create an account</h1>
            <p class="text-sm text-muted-foreground">Enter your information to create an account</p>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-1 gap-2">
                <button
                    disabled
                    wire:click="steamRegister"
                    type="button"
                    class="flex items-center justify-center gap-2 bg-card hover:bg-muted border border-input px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gamepad-2">
                        <line x1="6" x2="10" y1="11" y2="11"/>
                        <line x1="8" x2="8" y1="9" y2="13"/>
                        <line x1="15" x2="15.01" y1="12" y2="12"/>
                        <line x1="18" x2="18.01" y1="10" y2="10"/>
                        <path d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.544-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.152A4 4 0 0 0 17.32 5z"/>
                    </svg>
                    Sign up with Steam
                </button>
            </div>

            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t"></span>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-background px-2 text-muted-foreground">Or continue with</span>
                </div>
            </div>

            <form wire:submit.prevent="register" class="space-y-4">
                <div class="space-y-2">
                    <label for="name" class="text-sm font-medium">Name</label>
                    <input
                        wire:model.lazy="name"
                        type="text"
                        id="name"
                        class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('name') border-destructive @enderror"
                        placeholder="John Doe"
                    >
                    @error('name') <span class="text-destructive text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input
                        wire:model.lazy="email"
                        type="email"
                        id="email"
                        class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('email') border-destructive @enderror"
                        placeholder="name@example.com"
                    >
                    @error('email') <span class="text-destructive text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium">Password</label>
                    <input
                        wire:model.lazy="password"
                        type="password"
                        id="password"
                        class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background @error('password') border-destructive @enderror"
                    >
                    @error('password') <span class="text-destructive text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-medium">Confirm Password</label>
                    <input
                        wire:model.lazy="password_confirmation"
                        type="password"
                        id="password_confirmation"
                        class="w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background"
                    >
                </div>

                <div class="flex items-center space-x-2">
                    <input
                        type="checkbox"
                        id="terms"
                        class="h-4 w-4 rounded border-input bg-background text-primary focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
                        required
                    >
                    <label for="terms" class="text-sm">
                        I agree to the
                        <a href="#" class="font-medium text-primary hover:underline">Terms of Service</a>
                        and
                        <a href="#" class="font-medium text-primary hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                >
                    Create Account
                </button>
            </form>
        </div>

        <div class="text-center text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
                Sign in
            </a>
        </div>
    </div>
</div>

