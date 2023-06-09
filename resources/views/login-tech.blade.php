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

                        <h1 class="heading"><a href="/">Kahuna Techs</a></h1>



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
                            for="tab-1" class="tab">Login As A Technician</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label
                            for="tab-2" class="tab"></label>
                        <div class="login-space">
                            <div class="login">

                                <!--LOGIN FORM -->
                                <form method="POST" action="/login-user-tech">
                                    @csrf
                                    <div class="group">
                                        <div class="input-container">
                                            <input id="email" type="email" class="input" name="email"
                                                data-type="email">
                                            <label for="email" class="floating-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="input-container">
                                            <input id="password" type="password" class="input" name="password"
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
                            </div>

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
