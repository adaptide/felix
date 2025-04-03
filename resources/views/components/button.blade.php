<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200']) }}>
    {{ $slot }}
</button>

