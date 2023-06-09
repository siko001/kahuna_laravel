<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/main.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kahuna</title>
</head>

<body>

    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip">

                        <h1 class="heading"><a href="/">Kahuna</a></h1>



                        @if (session('success'))
                            <div class="container container--narrow">
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @elseif(session()->has('failure'))
                                <div class="container container--narrow">
                                    <div class="alert alert-danger text-center">
                                        {{ session('failure') }}
                                    </div>
                        @endif



                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label
                            for="tab-1" class="tab">Login</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label
                            for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <div class="login">

                                <!--LOGIN FORM -->
                                <form method="POST" action="login">
                                    @csrf

                                    <div class="group">
                                        <div class="input-container">
                                            <label for="username-input" class="floating-label">Username</label>
                                            <input id="loginuser" type="text" class="input" name="loginUsername">
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="input-container">
                                            <input id="loginpass" type="password" class="input" name="loginPassword"
                                                data-type="password">
                                            <label for="password-input" class="floating-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <input id="check" type="checkbox" class="check" checked>
                                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                                    </div>
                                    <div class="group">
                                        <input type="submit" class="button" value="Sign In">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </form>
                                @if ($errors->any())
                                    <h2 class="backend-error">Registration Error</h2>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="backend-error black">@lang($error)</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>


                            <!--Register FORM -->
                            <form method="POST" action="register" id="register-form">
                                @csrf

                                <div class="form-group">
                                    <div class="sign-up-form">
                                        <div class="group">
                                            <p class="username-notice"></p>
                                            @error('username')
                                                <span class="backend-error username">{{ $message }}</span>
                                            @enderror
                                            <div class="input-container">
                                                <input id="usernamereg" name="username" type="text"
                                                    class="input usernamereg">
                                                <label for="username-input" class="floating-label">Username</label>

                                            </div>
                                        </div>


                                        <div class="group">
                                            <p class="email-notice" id="email-notice"></p>
                                            @error('email')
                                                <span class="backend-error email">{{ $message }}</span>
                                            @enderror
                                            <div class="input-container">

                                                <input id="emailreg" type="text" name="email"
                                                    class="input emailreg">
                                                <label for="email-input" class="floating-label">Email</label>
                                            </div>
                                        </div>


                                        <div class="group">
                                            <p class="notice" id="password-notice"></p>
                                            @error('password')
                                                <span class="backend-error password">{{ $message }}</span>
                                            @enderror
                                            <div class="input-container">

                                                <input id="password" name="password" type="password" class="input"
                                                    data-type="passowrd">
                                                <label for="password" class="floating-label">Password</label>
                                            </div>
                                        </div>


                                        <div class="group">
                                            <p class="notice" id="cpassword-notice"></p>
                                            @error('cpassword')
                                                <span class="backend-error cpassword">{{ $message }}</span>
                                            @enderror
                                            <div class="input-container">

                                                <input id="cpassword" name="cpassword" type="password"
                                                    class="input" data-type="password">
                                                <label for="cpassword" class="floating-label">Confirm
                                                    Password</label>
                                            </div>
                                        </div>
                                        <div class="group">
                                            <input type="submit" class="button" value="Sign Up">
                                        </div>
                            </form>
                            <div class="hr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/val.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
