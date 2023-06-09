<x-layout>

    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">Add a new product</h2>
                </div>
            </div>
        </div>
    </header>
    <section class="contact-section section-padding pt-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-12 text-center">
                    <form action="/add-new-product" method="POST" class="custom-form contact-form" role="form"
                        enctype="multipart/form-data">
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

                        @if ($errors->any())

                            @foreach ($errors->all() as $error)
                                <p class="backend-error">@lang($error)</p>
                            @endforeach

                        @endif
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <input type="text" name="serialNumber" class="form-control serialNumber"
                                        placeholder="Serial Number">
                                    <label for="floatingInput">Serial Number</label>
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <input type="text" name="type" class="form-control"
                                        placeholder="Product Type">
                                    <label for="floatingInput">Product type</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-floating">
                                    <p class="confirm-new-password-notice"></p>
                                    <textarea type="text" name="description" class="form-control" placeholder="Product Description"></textarea>
                                    <label for="floatingInput">Product Description</label>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="imageURL"><br><br>
                        <h4 class="mb-4" for="tags">Tags</h4>
                        @php
                            $chunkedTags = array_chunk($tags->toArray(), 3);
                        @endphp

                        @foreach ($chunkedTags as $chunk)
                            <div class="row mb-2">
                                @foreach ($chunk as $tag)
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="tags[]"
                                                value="{{ $tag['id'] }}">
                                            <label class="form-check-label">{{ $tag['name'] }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <br><br><br>
                        <button type="submit">Add A new Product</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-layout>