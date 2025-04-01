@props(['img' => '', 'alt' => ''])
<img src="{{ $img ? asset('storage/'.$img) : 'https://ui-avatars.com/api/?name=' . urlencode(substr($alt, 0, 1)) . '&color=FF801A&background=0F172A' }}"
    alt="{{ $alt }}" {{ $attributes }}>