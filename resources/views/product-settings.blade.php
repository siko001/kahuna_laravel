<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 text-center">

                    <h2 class="mb-0">Product Settings</h2>
                </div>

            </div>
        </div>
    </header>

    @if (auth()->user())
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



        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="section-title-wrap mb-5">
                        <h4 class="section-title">Removing A product?</h4>
                    </div>
                </div>
            </div>
        </div>
        <section class="trending-podcast-section section-padding pt-0">
            <div class="container">
                <div class="row">
                    @foreach (auth()->user()->registeredProducts as $regProduct)
                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="javascript:void(0)">
                                        <img src="{{ Storage::url($regProduct->imgURL) }}"
                                            class="custom-block-image img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="javascript:void(0)">
                                            {{ $regProduct->type }}
                                        </a>
                                    </h5>

                                    <div class="profile-block d-flex">
                                        <!-- if owned the image is green very good mark -->
                                        @if (auth()->user()->regProduct)
                                            <img src="images/verified.png" class="profile-block-image img-fluid"
                                                alt="Owned">
                                            <p style="position:relative;left:-5px; top:12px;">Product Registered</p>
                                        @else
                                        @endif


                                    </div>

                                    <p class="mb-0">{{ $regProduct->description }}</p>

                                    <div class="custom-block-bottom d-flex justify-content-between mt-3">
                                        @unless ($regProduct->type !== 'Oven' && $regProduct->type !== 'Hob')
                                            <a href="https://www.tasteofhome.com/collection/our-100-highest-rated-recipes-ever/"
                                                class="bi bi-book">
                                                <span>100+ Recipies</span>
                                            </a>
                                        @else
                                        @endunless




                                        <a href="{{ route('technicians.byProduct', ['product' => $regProduct->product_id]) }}"
                                            class="bi bi-wrench-adjustable">
                                            <span>{{ $totalTechnicianCounts[$regProduct->type] }} Technicians</span>
                                        </a>
                                    </div>
                                </div>


                                @if (auth()->check())
                                    <div class="social-share d-flex flex-column ms-auto">

                                        <div class="badge ms-auto" style="color:red"
                                            onclick="showOverlayRemove({{ $regProduct->id }})"> <i
                                                class="bi bi-x-circle"></i>
                                        </div><span class="hover-text" style="color:red;font-weight:bold;">
                                            Remove Product
                                        </span>
                                    </div>
                                @else
                                @endif



                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <div class="d-flex align-items-center justify-content-center" style="min-height: 30vh;">
            <div class="text-center">
                <h4 style="margin-bottom: 20px;">
                    Please <a href="/login">Sign in</a> to change your settings
                </h4>
            </div>
        </div>
    @endif

    </main>
</x-layout>
