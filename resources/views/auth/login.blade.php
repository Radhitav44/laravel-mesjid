<!DOCTYPE html>
<html lang="en">
    @include('auth.head')

    <body class="form">
        @include('auth.loader')
        <div class="form-container outer">
            <div class="form-form">
                <div class="form-form-wrap">
                    <div class="form-container">
                        <div class="form-content">

                            <h1 class="">Sign In</h1>
                            <p class="">Log in to your account to continue.</p>

                            <form method="POST" action="{{ route('login') }}" class="text-left">

                                @csrf

                                <div class="form">

                                    <div id="username-field" class="field-wrapper input">
                                        <label for="username">Email/Kontak</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <input id="username" type="text" placeholder="Email/Kontak"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="admin@mail.com" required autocomplete="username" autofocus>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">PASSWORD</label>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <input id="password" name="password" type="password" placeholder="Password"
                                            value="secret12345"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                            class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper">
                                            <button type="submit" class="btn btn-primary"
                                                value="">{{ __('Login') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div> @include('auth.body')
    </body>

</html>
