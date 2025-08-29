@props([
    'color' => 'black', // default color if not provided
    'bgColor' => 'white', // default background color if not provided
])

@php
    $attributes = $attributes->merge([
        'class' => "card card-text-{$color} card-bg-{$bgColor} " . ($attributes->get('class') ?? '')
    ]);
    
    if (!$attributes->has('lang')) {
        $attributes = $attributes->merge(['lang' => 'ar']);
    }
@endphp

<div {{ $attributes }}>
    @if(isset($title))
        <div {{ $title->attributes->class("card-header") }}>
            {{ $title }}
        </div>
    @endif
    
    <div class="card-body">
        @if ($slot->isEmpty())
            <p>Please provide some content</p>
        @else
            {{ $slot }}
        @endif
    </div>
    
    @if(isset($footer))
        <div {{ $footer->attributes->class("card-footer") }}>
            {{ $footer }}
        </div>
    @endif
</div>
