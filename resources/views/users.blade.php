 <x-layout>
     <header class="site-header d-flex flex-column justify-content-center align-items-center">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 col-12 text-center">
                     <h2 class="mb-0">View All Registsered Users</h2>
                 </div>
             </div>
         </div>
     </header>
     <section class="trending-podcast-section section-padding pt-0">
         <div class="container">
             <div class="row">

                 @foreach ($users as $user)
                     <div class="col-md-4 mb-4">
                         <div class="card">
                             <div class="card-body">
                                 <h4 style="text-decoration: underline">
                                     @if ($user->name == null)
                                         {{ $user->username }}
                                     @elseif ($user->surname && $user->name)
                                         {{ $user->name }} {{ $user->surname }}
                                     @else
                                         {{ $user->name }} {{ $user->surname }}
                                     @endif
                                 </h4>
                                 <hr>
                                 <p>Email: <strong>{{ $user->email }}</strong></p>
                                 <p>Phone: <strong>{{ $user->phone_number }}</strong></p>
                                 <hr>
                                 <h6>Registered Products</h6>
                                 <div class="row">
                                     @foreach ($user->registeredProducts as $index => $registeredProduct)
                                         @php
                                             $product = $registeredProduct->product;
                                         @endphp
                                         <div class="col-md-4">
                                             <a
                                                 href="{{ route('technicians.byProduct', ['product' => $product->id]) }}">{{ $product->type }}</a>
                                         </div>
                                         @if (($index + 1) % 3 === 0)
                                 </div>
                                 <div class="row">
                 @endif
                 @endforeach
             </div>

         </div>
         </div>
         </div>
         @endforeach

         </div>
         </div>
     </section>

 </x-layout>
