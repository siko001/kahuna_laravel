<x-layout>
    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">All Technicians For {{ $product->type }}</h2>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            @foreach ($technicians as $technician)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-decoration: underline">{{ $technician->fullname }}</h4>

                            <p>Email: <strong>{{ $technician->email }}</strong></p>
                            <p>Phone: <strong>{{ $technician->phone }}</strong></p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
