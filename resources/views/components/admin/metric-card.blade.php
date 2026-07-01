@props(['label', 'value', 'icon' => 'fa-chart-line', 'tone' => 'blue'])

@php
    $toneClasses = [
        'emerald' => 'bg-emerald-50 text-emerald-600',
        'blue' => 'bg-blue-50 text-blue-600',
        'purple' => 'bg-purple-50 text-purple-600',
        'orange' => 'bg-orange-50 text-orange-600',
    ];
@endphp

<div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm text-gray-600 mb-2">{{ $label }}</p>
            <p class="text-3xl font-bold text-gray-900">{{ $value }}</p>
        </div>
        <div class="p-3 rounded-lg {{ $toneClasses[$tone] ?? $toneClasses['blue'] }}">
            <i class="fas {{ $icon }} text-xl"></i>
        </div>
    </div>
</div>
