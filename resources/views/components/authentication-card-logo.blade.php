<a href="/">
    @php
    $favicons = ['favicon_1.png', 'favicon_2.png', 'favicon_3.png', 'favicon_4.png', 'favicon_5.png', 'favicon_6.png', 'favicon_7.png'];
    $randomFavicon = $favicons[array_rand($favicons)];
@endphp
    <img src="{{ asset($randomFavicon) }}" alt="Logo" width="150" height="150" />
</a>
