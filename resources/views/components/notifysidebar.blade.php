<div class="profile-tab-list">
    <ul>
        {{-- <li><a href="{{ route('f.visibility.status') }}" >Visibility</a></li> --}}
        <li><a href="{{ route('f.blocked.profile') }}"
                class="{{ Route::is('f.blocked.profile') ? 'curent' : '' }}">Blocked profiles</a></li>
        {{-- <li><a href="{{ route('f.remove.profile') }}" >Removed profiles</a></li> --}}
        <li><a href="{{ route('f.email.notify') }}" class="{{ Route::is('f.email.notify') ? 'curent' : '' }}">Email
                notifications</a></li>
        {{-- <li><a href="{{ route('f.push.notify') }}" class="{{ Route::is('f.push.notify') ? 'curent' : '' }}">Push
                notifications</a></li> --}}
    </ul>
</div>
