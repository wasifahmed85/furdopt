<section class="login-wrap">
    <div class="common-wrap clear">
        <div class="login-inner">
            <div class="login-title">
                <h2>Login</h2>
            </div>
            {{-- <div class="login-access-wrap">
                <span>Username: <strong>emily4</strong></span>
                <span>Password: <strong>admin@1234</strong></span>
            </div> --}}
            {{-- <div class="google-btn">
                <a href="#">Continue with Google</a>
            </div>
            <div class="google-btn">
                <a href="#">Continue with Facebook</a>
            </div>
            <div class="devided-or">
                <span>or</span>
            </div> --}}
            <div class="login-form-wrap">
                <form wire:submit.prevent="login">

                    <div class="login-input-raw">
                        <input type="email" placeholder="mail@example.com" wire:model.lazy="email">
                        @error('email')
                            <span class="text-red-500 text-sm error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="login-input-raw pass">
                        <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model.live="password"
                            placeholder="Enter your Password">
                        <div class="eye-icon">
                            <img src="{{ asset('customer') }}/svgs/mage_eye-off.svg" alt="eye"
                                wire:click="togglePasswordVisibility">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="checkbox-wrap">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox" name="checkbox-1" value="checkbox-1">
                            <label for="checkbox">Remember me</label>
                        </div>
                        <div class="forgot-link">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="login-input-raw">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>

                <div class="account">Not registered yet? <a href="{{ route('f.register') }}"> Create an Account</a>
                </div>
            </div>
        </div>
    </div>
</section>


@script
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endscript
