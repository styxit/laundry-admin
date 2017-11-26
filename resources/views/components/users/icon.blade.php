@php
    $hash = trim(md5($email));
    $gravatarOptions = [
        'size' => '256',
        'default' => 'mm',
    ];
@endphp

<img class="img-circle" src="https://www.gravatar.com/avatar/{{ $hash }}?{{ http_build_query($gravatarOptions) }}" alt="User Avatar">
