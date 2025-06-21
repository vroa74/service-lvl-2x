@props(['name', 'size' => '24', 'class' => '', 'stroke' => '2'])

<i data-lucide="{{ $name }}" 
   class="{{ $class }}"
   style="width: {{ $size }}px; height: {{ $size }}px; stroke-width: {{ $stroke }};">
</i> 