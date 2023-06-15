<x-layout>
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="text-center mb-8 pb-2">
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




                        @if (Auth::check())
                            <div class="container-welcome">
                                <h1 class="text-white mb-2">Welcome
                                    @if (auth()->user()->name && auth()->user()->surname)
                                        {{ auth()->user()->name }} {{ auth()->user()->surname }}
                                </h1>
                            @elseif(auth()->user()->name)
                                {{ auth()->user()->name }}</h1>
                            @else
                                {{ auth()->user()->username }}</h1>
                        @endif
                        <p class="text-white">View your registered products <a style="color:black;"
                                onmouseover="this.style.color='#00cc99'" onmouseout="this.style.color='black'"
                                href="/#registeredProductsSection">below
                        </p>
                        <a href="/register-product" class="btn custom-btn smoothscroll mt-3"
                            style="margin-bottom:10px;">Register A
                            Product</a>
                    </div>
                @elseif(Auth::guard('technician')->check())
                    <div class="container-welcome">
                        <h1 class="text-white">Welcome Kahuna <a href="javascript:void(0)">Tech</a>
                            {{ Auth::guard('technician')->user()->fullname }}
                        </h1>
                        <h4 style="margin-bottom:20px;"> </h4>
                    </div>
                @else
                    <div class="container-welcome">
                        <h1 class="text-white">Welcome</h1>
                        <h4 style="margin-bottom:20px;"> Please <a href="/login">Sign in</a> to view your
                            products<br> or <a href="/login#register">Register</a> To get Started</h4>
                    </div>
                    @endif


                    <div class="owl-carousel owl-theme">



                        @foreach ($products as $product)
                            <div style="width: 240px; min-height: 400px;" class="owl-carousel-info-wrap item media">
                                <img src="{{ Storage::url($product->imgURL) }}" class="owl-carousel-image img-fluid"
                                    alt="" />
                                <div class="owl-carousel-info">
                                    <h5 style="font-size:18px; font-weight:bold;" class="mb-2">
                                        {{ $product->type }} </h5>

                                    @foreach ($product->tags as $tag)
                                        <span class="badge">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>



    @if (auth()->check())
        <section class="trending-podcast-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h4 id="registeredProductsSection" class="section-title">Your Registered
                                Products</h4>
                        </div>
                    </div>
                    @foreach (auth()->user()->registeredProducts as $registeredProduct)
                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="javascript:void(0)">
                                        <img src="{{ Storage::url($registeredProduct->imgURL) }}"
                                            class="custom-block-image img-fluid" alt="" />
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="javascript:void(0)">{{ $registeredProduct->type }}</a>
                                    </h5>
                                    <p class="mb-0">{{ $registeredProduct->description }}</p>

                                    <div class="custom-block-bottom mt-2">
                                        <a href="javascript:void(0)" class="bi bi-house-heart-fill">
                                            <span>
                                                <p class="ss">Total Registered {{ $registeredProduct->type }}s:
                                                </p>
                                                {{ $totalCounts[$registeredProduct->type] }}
                                            </span>
                                        </a>
                                        <a href="{{ route('technicians.byProduct', ['product' => $registeredProduct->product_id]) }}"
                                            class="bi bi-wrench-adjustable">
                                            <span>
                                                <p class="ss">Total Technicians for
                                                    {{ $registeredProduct->type }}s:</p>
                                                {{ $totalTechnicianCounts[$registeredProduct->type] }}

                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="social-share d-flex flex-column ms-auto">

                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if (auth()->user()->registeredProducts->isEmpty())
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <h4>Please <a href="/register-product">Register</a> a Product</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
        </section>
    @elseif(Auth::guard('technician')->check())
        <!-- Guest-specific content here -->
        <section class="trending-podcast-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h4 class="section-title">Your Specialized Appliances</h4>
                        </div>
                    </div>
                    @foreach (Auth::guard('technician')->user()->products as $product)
                        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                            <div class="custom-block custom-block-full">
                                <div class="custom-block-image-wrap">
                                    <a href="javascript:void(0)">
                                        <img src="{{ Storage::url($product->imgURL) }}"
                                            class="custom-block-image img-fluid" alt="" />
                                    </a>
                                </div>

                                <div class="custom-block-info">
                                    <h5 class="mb-2">
                                        <a href="javascript:void(0)">{{ $product->type }}</a>
                                    </h5>
                                    <p class="mb-0">{{ $product->description }}</p>

                                    <div class="custom-block-bottom mt-2">
                                        <a href="javascript:void(0)" class="bi bi-house-heart-fill">
                                            <span>
                                                <p class="ss">Total Registered {{ $product->type }}s:
                                                </p>
                                                {{ $totalCounts[$product->type] }}
                                            </span>
                                        </a>
                                        <a href="{{ route('technicians.byProduct', ['product' => $product->id]) }}"
                                            class="bi bi-wrench-adjustable">
                                            <span>
                                                <p class="ss">Total Technicians for
                                                    {{ $product->type }}s:</p>
                                                {{ $totalTechnicianCounts[$product->type] }}

                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="social-share d-flex flex-column ms-auto">

                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <!-- Guest-specific content here -->
        <section class="trending-podcast-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="section-title-wrap mb-5">
                            <h4 class="section-title">Your Registered Products</h4>
                            <h4 style="margin-top:120px; margin-bottom:-100px"> Please <a href="/login">Sign in</a>
                                to view your
                                products<br> or <a href="/login#register">Register</a> To get Started</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif




    <section class="topics-section section-padding pb-0" id="section_3">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-12 col-12">
                    <div class="section-title-wrap mb-5">
                        <h4 class="section-title">
                            {{ Auth::guard('technician')->check() ? 'Find Colleagues' : 'Services and Advice' }}</h4>
                    </div>
                </div>



                <div class="col-lg-6 col-md-9 col-12 mb-4 mb-lg-0 ">
                    <div class="custom-block custom-block-overlay">
                        <a href="/help-center" class="custom-block-image-wrap">
                            <img src="images/topics/repairman-doing-air-conditioner-service.jpg"
                                class="custom-block-image img-fluid" alt="" />
                        </a>
                        <div class="custom-block-info custom-block-overlay-info">
                            <h5 class="mb-1">
                                <a href="/help-center   ">{{ Auth::guard('technician')->check() ? 'All Technicians' : 'Find A Technician' }}
                                </a>
                            </h5>
                            <p class="badge mb-0"> {{ count($technicians) }}
                                {{ Auth::guard('technician')->check() ? 'Registered Colleagues' : 'Qualified Technicians' }}
                            </p>
                        </div>
                    </div>
                </div>


                @if (Auth::guard('technician')->check())
                @else
                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block custom-block-overlay">
                            <a href="https://www.tasteofhome.com/collection/our-100-highest-rated-recipes-ever/"
                                class="custom-block-image-wrap">
                                <img src="images/topics/delicious-meal-with-sambal-arrangement.jpg"
                                    class="custom-block-image img-fluid" alt="" />
                            </a>

                            <div class="custom-block-info custom-block-overlay-info">
                                <h5 class="mb-1">
                                    <a
                                        href="https://www.tasteofhome.com/collection/our-100-highest-rated-recipes-ever/">
                                        Cooking and Recipies </a>
                                </h5>

                                <p class="badge mb-0">90+ Recipies</p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
    </main>


</x-layout>
