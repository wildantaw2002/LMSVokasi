<!-- Statistics Card Component -->
<div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600 text-sm font-medium">{{ $label }}</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $value }}</p>
            @if(isset($trend))
                <p class="text-xs text-green-600 mt-2">{{ $trend }}</p>
            @endif
        </div>
        <div class="w-16 h-16 rounded-full {{ $bgColor }} flex items-center justify-center">
            {!! $icon !!}
        </div>
    </div>
</div>
