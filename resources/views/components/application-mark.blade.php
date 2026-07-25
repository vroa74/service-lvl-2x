@php
$favicons = [];
for ($i = 1; $i <= 24; $i++) {
    $favicons[] = "img/{$i}.png";
}
$randomFavicon = $favicons[array_rand($favicons)];
@endphp
<picture>
    <source srcset="{{ asset($randomFavicon) }}" type="image/png" width="50px" height="50px">
    <img src="{{ asset($randomFavicon) }}" alt="Logo" {{ $attributes }}  width="50px" height="50px" >
</picture>
