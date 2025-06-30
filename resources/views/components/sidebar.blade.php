<div class="profile-sidebar">
    <div class="profile-nav">
        <div class="profile-nav-item">
            <a href="{{ route('f.petlisting') }}"
                class="profile-nav-title {{ Route::is('f.petlisting') ? 'curent' : '' }}">My Listings</a>
        </div>
     
        <div
            class="profile-nav-item">
            <a href="#"
                class="profile-nav-title">Manage
                account</a>
            <ul class="profile-nav-list {{ Route::is('f.subscription') ? 'active' : '' }}{{ Route::is('f.payment.method') ? 'active' : '' }} {{ Route::is('f.billing') ? 'active' : '' }}">
                <li><a href="{{ route('f.subscription') }}" class="{{ Route::is('f.subscription') ? 'curent' : '' }}">Subscription</a></li>
                <li><a href="{{ route('f.payment.method') }}" class="{{ Route::is('f.payment.method') ? 'curent' : '' }}">Payment method</a></li>
                <li><a href="{{ route('f.billing') }}" class="{{ Route::is('f.billing') ? 'curent' : '' }}">Billing</a></li>
            </ul>
        </div>
        

        <div class="profile-nav-item">
            <a href="#" class="profile-nav-title">Profile Setting</a>
            <h6></h6>
            <ul class="profile-nav-list {{ Route::is('f.base') ? 'active' : '' }}{{ Route::is('f.interest') ? 'active' : '' }} {{ Route::is('f.sport') ? 'active' : '' }} {{ Route::is('f.lookingfor') ? 'active' : '' }}">
                {{-- <li><a href="{{ route('f.about') }}" >About</a></li> --}}
                <li><a href="{{ route('f.base') }}" class="{{ Route::is('f.base') ? 'curent' : '' }}">Basic Info</a></li>
              
              
                <li><a href="{{ route('f.lookingfor') }}" class="{{ Route::is('f.lookingfor') ? 'curent' : '' }}">What I'm looking for</a></li>
            </ul>
        </div>
        <div class="profile-nav-item">
            <a href="#"
                class="profile-nav-title">Account
                Settings</a>
            <ul class="profile-nav-list {{ Route::is('f.setting') ? 'active' : '' }}{{ Route::is('f.social') ? 'active' : '' }} ">
                <li><a href="{{ route('f.setting') }}" class="{{ Route::is('f.setting') ? 'curent' : '' }}">General</a></li>
                 {{--
                
                <li><a href="{{ route('f.social') }}" class="{{ Route::is('f.social') ? 'curent' : '' }}">Social Accounts</a></li>
                --}}
                
            </ul>
        </div>
        {{-- <div class="profile-nav-item">
            <a href="{{ route('f.visibility.status') }}"  class="profile-nav-title">Visibility</a>
        </div> --}}
        <div class="profile-nav-item">
            <a href="{{ route('f.blocked.profile') }}"
                class="profile-nav-title {{ Route::is('f.blocked.profile') ? 'curent' : '' }}">Blocked Profiles</a>
        </div>
        {{-- <div class="profile-nav-item">
            <a href="{{ route('f.remove.profile') }}"  class="profile-nav-title">Removed Profiles</a>
        </div> --}}
        <div class="profile-nav-item">
            <a href="{{ route('f.email.notify') }}"
                class="profile-nav-title {{ Route::is('f.email.notify') ? 'curent' : '' }}">Email notifications</a>
        </div>
        {{-- <div class="profile-nav-item">
            <a href="{{ route('f.push.notify') }}"
                class="profile-nav-title {{ Route::is('f.push.notify') ? 'curent' : '' }}">Push notifications</a>
        </div> --}}
    </div>
</div>
