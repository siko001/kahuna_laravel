<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">Technician Registration</h2>
                </div>
            </div>
        </div>
    </header>
    <section class="contact-section section-padding pt-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-8 col-10">
                            <div class="section-title-wrap mb-5">
                                <h4 class="section-title">Register your expertise with Kahuna</h4>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="/register-technician">
                        @csrf
                        <!-- Form content -->
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-8 col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="fullname" id="full-name" class="form-control"
                                        required="">
                                    <label for="floatingInput">Full Name</label> @error('fullname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-12">
                                <div class="form-floating">
                                    <input type="text" name="email" id="email" class="form-control"
                                        required="">
                                    <label for="floatingInput">Email</label> @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-lg-6 col-md-8 col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" name="password" id="password" class="form-control"
                                        required="">
                                    <label for="floatingInput">Password</label> @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-8 col-12">
                                <div class="form-floating">
                                    <input type="text" name="confirm-password" id="confirm-password"
                                        class="form-control" required="">
                                    <label for="floatingInput">Confirm Password</label> @error('confirm-password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-8 col-12 mt-3">
                                <div class="form-floating">
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        required="">
                                    <label for="floatingInput">Phone number</label> @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="justify-content-center d-flex">
                                <h5 class="mb-4" for="products">Specialization Products</h5><br>
                            </div>
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" id="product{{ $product->id }}" name="products[]"
                                                value="{{ $product->id }}" class="form-check-input">
                                            <label for="product{{ $product->id }}"
                                                class="form-check-label mb-2">{{ $product->type }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <button type="submit" class="form-control">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-layout>
