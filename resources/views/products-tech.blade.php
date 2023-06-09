 <x-layout>
     <header class="site-header d-flex flex-column justify-content-center align-items-center">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 col-12 text-center">
                     <h2 class="mb-0">All Your Specializing Products</h2>
                 </div>
             </div>
         </div>
     </header>
     <section class="trending-podcast-section section-padding pt-0">
         <div class="container">
             <div class="row">

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

                                     <a href="{{ route('technicians.byProduct', ['product' => $product->id]) }}"
                                         class="bi bi-wrench-adjustable">
                                         View all Techs for {{ $product->type }}
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

 </x-layout>
