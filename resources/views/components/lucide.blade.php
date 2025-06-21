@props(['name', 'class' => ''])

<svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    @switch($name)
        @case('x')
            <path d="M18 6 6 18"/>
            <path d="m6 6 12 12"/>
            @break
        @case('search')
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.35-4.35"/>
            @break
        @case('plus')
            <path d="M5 12h14"/>
            <path d="M12 5v14"/>
            @break
        @case('user')
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
            @break
        @case('edit')
            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
            <path d="m15 5 4 4"/>
            @break
        @case('toggle-left')
            <rect width="20" height="12" x="2" y="6" rx="2" ry="2"/>
            <path d="m9 12 2 2 4-4"/>
            @break
        @case('trash-2')
            <path d="M3 6h18"/>
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
            <line x1="10" x2="10" y1="11" y2="17"/>
            <line x1="14" x2="14" y1="11" y2="17"/>
            @break
        @case('users')
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            @break
        @case('save')
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17,21 17,13 7,13 7,21"/>
            <polyline points="7,3 7,8 15,8"/>
            @break
        @case('menu')
            <line x1="4" x2="20" y1="12" y2="12"/>
            <line x1="4" x2="20" y1="6" y2="6"/>
            <line x1="4" x2="20" y1="18" y2="18"/>
            @break
        @case('chevron-down')
            <path d="m6 9 6 6 6-6"/>
            @break
        @case('wrench')
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
            @break
        @case('male')
            <circle cx="9" cy="9" r="5"/>
            <path d="M14 14 21 21"/>
            <path d="M21 14 14 21"/>
            @break
        @case('female')
            <circle cx="12" cy="8" r="5"/>
            <path d="M12 13v8"/>
            <path d="M8 17h8"/>
            @break
        @default
            <!-- Icono por defecto o mensaje de error -->
            <circle cx="12" cy="12" r="10"/>
            <path d="M8 12h8"/>
            <path d="M12 8v8"/>
    @endswitch
</svg> 