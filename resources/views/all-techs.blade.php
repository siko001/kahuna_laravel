<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">All Technicians</h2>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <h3>Find Prodcuct Tech for: </h3>
        @foreach ($products as $key => $product)
            <a style="margin-bottom:25px;"
                href="{{ route('technicians.byProduct', ['product' => $product->id]) }}">{{ $product->type }}</a>
            @if (!$loop->last)
                |
            @endif
        @endforeach

        <div class="row justify-content-center">



            @foreach ($technicians as $technician)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-decoration: underline">{{ $technician->fullname }}</h4>
                            <h6>Technician on:</h6>
                            @foreach ($technician->specializations as $index => $specialization)
                                <div class="col"><a
                                        href=" {{ route('technicians.specialized', ['type' => $specialization->type]) }}">{{ $specialization->type }}</a>
                                </div>
                            @endforeach
                            <hr>
                            <p>Email: <strong>{{ $technician->email }}</strong></p>
                            <p>Phone: <strong>{{ $technician->phone }}</strong></p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
