<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 text-center">

                    <h2 class="mb-0">Profile-Settings</h2>
                </div>

            </div>
        </div>
    </header>

    @if (auth()->check())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-12 pe-lg-5">
                    <div class="contact-info">
                        <h3 class="mb-4">Your Information</h3>

                        @if (session('success'))
                            <div class="container container--narrow">
                                <div class="container justify-content-center col-lg-4 alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @elseif(session()->has('failure'))
                            <div class="container container--narrow">
                                <div class="alert alert-danger text-center">
                                    {{ session('failure') }}
                                </div>
                            </div>
                        @endif


                        <p class="d-flex border-bottom pb-3 mb-4">

                            <strong class="d-inline me-4">Username:</strong>
                            <span>{{ auth()->user()->username }}</span>
                        </p>

                        <p class="d-flex border-bottom pb-3 mb-4">
                            <strong class="d-inline me-4">Email:</strong>
                            {{ auth()->user()->email }}
                        </p>

                        <p class="d-flex border-bottom pb-3 mb-4">
                            <strong class="d-inline me-4">Name:</strong>
                            <span> {{ auth()->user()->name }}</span>
                        </p>
                        <p class="d-flex border-bottom pb-3 mb-4">
                            <strong class="d-inline me-4">Surname:</strong>
                            <span> {{ auth()->user()->surname }}</span>
                        </p>
                        <p class="d-flex border-bottom pb-3 mb-4">
                            <strong class="d-inline me-4">Phone number:</strong>
                            <span> {{ auth()->user()->phone_number }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <section class="contact-section section-padding pt-0">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="section-title-wrap mb-5">
                            <h4 class="section-title">Fill in the form to update your Profile</h4>
                        </div>

                        <form action="profile-settings/{{ auth()->user()->id }}" method="POST"
                            class="custom-form contact-form" role="form">
                            @method('PUT')
                            @csrf
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="backend-error black">@lang($error)</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">

                                        <input type="text" name="username" id="usernameupdate"
                                            class="usernamereg form-control" placeholder="username">
                                        <p class="username-notice"></p>
                                        <label for="floatingInput">Username</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" pattern="[^ @]*@[^ @]*"
                                            class="emailreg form-control" placeholder="Email address" id="emailupdate">
                                        <p class="email-notice"></p>
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Name">
                                        <p class="name-notice"></p>
                                        <label for="floatingInput">Name</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="surname" id="surname" class="form-control"
                                            placeholder="Surname">
                                        <p class="surname-notice"></p>
                                        <label for="floatingInput">Surname</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            placeholder="phone">
                                        <p class="phone-notice"></p>
                                        <label for="floatingInput">Phone Number</label>
                                    </div>
                                    <h6><a href="/change-password">Change Password</a></h6>
                                    <br>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <button type="submit" class="form-control">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
        </main>
    @elseif (Auth::guard('technician')->check())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-12 pe-lg-5">
                    <div class="contact-info">
                        <h3 class="mb-4">Your Information</h3>

                        @if (session('success'))
                            <div class="container container--narrow">
                                <div class="container justify-content-center col-lg-4 alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @elseif(session()->has('failure'))
                            <div class="container container--narrow">
                                <div class="alert alert-danger text-center">
                                    {{ session('failure') }}
                                </div>
                            </div>
                        @endif


                        <p class="d-flex border-bottom pb-3 mb-4">

                            <strong class="d-inline me-4">Fullname:</strong>
                            <span>{{ Auth::guard('technician')->user()->fullname }}</span>
                        </p>

                        <p class="d-flex border-bottom pb-3 mb-4">
                            <strong class="d-inline me-4">Email:</strong>
                            {{ Auth::guard('technician')->user()->email }}
                        </p>
                        <p class="d-flex border-bottom pb-3 mb-4">
                            <strong class="d-inline me-4">Phone number:</strong>
                            <span> {{ Auth::guard('technician')->user()->phone }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <section class="contact-section section-padding pt-0">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="section-title-wrap mb-5">
                            <h4 class="section-title">Fill in the form to update your Profile</h4>
                        </div>

                        <form action="/profile-settings/tech/{{ Auth::guard('technician')->user()->id }}"
                            method="POST" class="custom-form contact-form" role="form">
                            @method('PUT')
                            @csrf
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="backend-error black">@lang($error)</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">

                                        <input type="text" name="fullname" id="fullname"
                                            class="fullname form-control" placeholder="fullname">
                                        <p class="fullname-notice"></p>
                                        <label for="floatingInput">Fullname</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" pattern="[^ @]*@[^ @]*"
                                            class="email form-control" placeholder="Email address" id="emailupdate">
                                        <p class="email-notice"></p>
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            placeholder="phone">
                                        <p class="phone-notice"></p>
                                        <label for="floatingInput">Phone Number</label>
                                    </div>
                                    <h6><a href="/change-password/tech">Change Password</a></h6>
                                    <br>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <button type="submit" class="form-control">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
        </main>
    @else
        <div class="d-flex align-items-center justify-content-center" style="min-height: 30vh;">
            <div class="text-center">
                <h4 style="margin-bottom: 20px;">
                    Please <a href="/login">Sign in</a> to change your settings
                </h4>
            </div>
        </div>
    @endif

</x-layout>
