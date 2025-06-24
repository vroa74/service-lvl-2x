@php
    $favicons = ['favicon_1.png', 'favicon_2.png', 'favicon_3.png', 'favicon_4.png', 'favicon_5.png', 'favicon_6.png', 'favicon_7.png'];
    $randomFavicon = $favicons[array_rand($favicons)];
@endphp
<picture>
    <source srcset="{{ asset($randomFavicon) }}" type="image/png">
    <img src="{{ asset($randomFavicon) }}" alt="Logo" {{ $attributes }}>
</picture>
