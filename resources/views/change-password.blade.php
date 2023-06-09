<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">Change your Password</h2>
                </div>
            </div>
        </div>
    </header>
    @if (auth()->check())
        <section class="contact-section section-padding pt-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12 text-center">
                        <form action="/change-password/{{ auth()->user()->id }}" method="POST"
                            class="custom-form contact-form" role="form">
                            @method('PUT')
                            @csrf
                            @if (session('success'))
                                <div class="container container--narrow">
                                    <div
                                        class="container justify-content-center col-lg-4 alert alert-success text-center">
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

                            @if ($errors->any())

                                @foreach ($errors->all() as $error)
                                    <p class="backend-error">@lang($error)</p>
                                @endforeach

                            @endif
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <p class="current-password-notice"></p>
                                        <input type="text" name="currentPassword"
                                            class="form-control current-password" placeholder="Enter Current Password">
                                        <label for="floatingInput">Current Password</label>
                                    </div>
                                </div>
                            </div>



                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <p class="new-password-notice"></p>
                                        <input type="text" name="newPassword" class="form-control new-password"
                                            placeholder="Enter New Password">
                                        <label for="floatingInput">New Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <p class="confirm-new-password-notice"></p>
                                        <input type="text" name="confirmNewPassword"
                                            class="form-control confirm-new-password" placeholder="Confirm Password">
                                        <label for="floatingInput">Confirm New Password</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="contact-section section-padding pt-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12 text-center">
                        <form action="/change-password/{{ Auth::guard('technician')->id() }}" method="POST"
                            class="custom-form contact-form" role="form">
                            @method('PUT')
                            @csrf
                            @if (session('success'))
                                <div class="container container--narrow">
                                    <div
                                        class="container justify-content-center col-lg-4 alert alert-success text-center">
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

                            @if ($errors->any())

                                @foreach ($errors->all() as $error)
                                    <p class="backend-error">@lang($error)</p>
                                @endforeach

                            @endif
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <p class="current-password-notice"></p>
                                        <input type="text" name="currentPassword"
                                            class="form-control current-password" placeholder="Enter Current Password">
                                        <label for="floatingInput">Current Password</label>
                                    </div>
                                </div>
                            </div>



                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <p class="new-password-notice"></p>
                                        <input type="text" name="newPassword" class="form-control new-password"
                                            placeholder="Enter New Password">
                                        <label for="floatingInput">New Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <p class="confirm-new-password-notice"></p>
                                        <input type="text" name="confirmNewPassword"
                                            class="form-control confirm-new-password" placeholder="Confirm Password">
                                        <label for="floatingInput">Confirm New Password</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>


    @endif




    < </x-layout>
