@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full px-3 py-2 rounded-md border focus:outline-none focus:ring-2 focus:ring-ring focus:border-input bg-background']) !!}>

