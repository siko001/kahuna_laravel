<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 text-center">

                    <h2 class="mb-0">View Our Range Of Products Avaliable</h2>
                </div>

            </div>
        </div>
    </header>


    <section class="trending-podcast-section section-padding pt-0">
        <div class="container">
            <div class="row">

                @foreach ($products as $product)
                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block custom-block-full">
                            <div class="custom-block-image-wrap">
                                <a href="javascript:void(0)">
                                    <img src="{{ Storage::url($product->imgURL) }}" class="custom-block-image img-fluid"
                                        alt="">
                                </a>
                            </div>

                            <div class="custom-block-info">
                                <h5 class="mb-2">
                                    <a style="text-decoration: underline" href="javascript:void(0)">
                                        {{ $product->type }}
                                    </a>
                                </h5>

                                <div class="profile-block d-flex">
                                    <p>Serial Number
                                        <strong>{{ $product->serialNumber }}</strong>
                                    </p>


                                    <!-- if owned the image is green very good mark -->
                                    @php
                                        $productId = $product->id;
                                        $isProductRegistered =
                                            auth()->check() &&
                                            auth()
                                                ->user()
                                                ->registeredProducts()
                                                ->where('product_id', $productId)
                                                ->exists();
                                    @endphp

                                    @if ($isProductRegistered)
                                        <img src="images/verified.png" class="profile-block-image img-fluid"
                                            alt="Owned">
                                        <p style="position:relative;left:-10px;">Product
                                            Registered</p>
                                    @endif


                                </div>

                                <p class="mb-0">{{ $product->description }} </p>
                                <hr>
                                <div class="custom-block-bottom d-flex justify-content-between mt-3">

                                    @if (
                                        $product->type == 'Fridge' ||
                                            $product->type == 'Washing Machine' ||
                                            $product->type == 'Tumble Dryer' ||
                                            $product->type == 'Dishwasher')
                                    @else
                                        <a href="https://www.tasteofhome.com/collection/our-100-highest-rated-recipes-ever/"
                                            target="_blank" class="bi bi-book">
                                            <span>100+ Recipies</span>
                                        </a>
                                    @endif



                                    <a href="{{ route('technicians.byProduct', ['product' => $product->id]) }}"
                                        class="bi bi-wrench-adjustable">
                                        <span>{{ $totalTechnicianCounts[$product->type] }} Technicians</span>
                                    </a>

                                </div>
                                <a href="javascript:void(0)">
                                    <span class="custom-block-bottom d-flex justify-content-between mt-3">
                                        {{ $totalCounts[$product->type] }} Total Registered
                                        {{ $product->type }}{{ $totalCounts[$product->type] <= 1 ? '' : 's' }}
                                    </span></a>
                            </div>



                            @if (auth()->user())
                                @if ($isProductRegistered)
                                @else
                                    <a id="myLink" href="/addProduct/{{ $product->id }}">
                                        <div class="social-share d-flex flex-column ms-auto">
                                            <div class="badge ms-auto" onclick="showOverlayAdd()"> <i
                                                    class="bi bi-plus-circle"></i>
                                            </div><span class="hover-text">
                                                Register Product
                                            </span>
                                        </div>
                                    </a>
                                @endif
                            @else
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>




    </main>

</x-layout>
