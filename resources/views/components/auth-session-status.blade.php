@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-100 text-green-800 p-4 rounded-md mb-4']) }}>
        {{ $status }}
    </div>
@endif

