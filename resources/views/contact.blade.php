<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">Contact Page</h2>
                </div>
            </div>
        </div>
    </header>


    <section class="contact-section section-padding pt-0">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 mx-auto">
                    <div class="section-title-wrap mb-5">
                        <h4 class="section-title">Fill in the form and we'll be in touch soon!</h4>
                    </div>

                    <form action="/contact-form" method="POST" class="custom-form contact-form" role="form">
                        @csrf
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

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <input type="text" name="full-name" id="full-name" class="form-control"
                                        value="{{ auth()->user() ? auth()->user()->username : '' }}" required="">

                                    <label for="floatingInput">Full Name</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                        class="form-control" value="{{ auth()->user() ? auth()->user()->email : '' }}"
                                        required="">

                                    <label for="floatingInput">Email address</label>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" id="subject" class="form-control"
                                        placeholder="subject" required="">

                                    <label for="floatingInput">Subject</label>
                                </div>

                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" placeholder="Describe message here"></textarea>

                                    <label for="floatingTextarea">Describe message here</label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-12 ms-auto">
                                <button type="submit" class="form-control">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    </main>
</x-layout>
