@props(['active' => false, 'img' => ''])

<a {{ $attributes->class(['sidenav-link', 'active' => $active]) }}>
    <img class="nav-link-img" src="{{ url($img) }}" alt="">
    <span class="nav-link-text">{{ $slot }}</span>
</a>
