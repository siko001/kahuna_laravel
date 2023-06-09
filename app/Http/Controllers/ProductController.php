<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Product;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\RegisteredProduct;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {

    //to add a Product
    public function addProduct(Request $request) {
        $incomingFields = $request->validate([
            "serialNumber" => ["required", "numeric", Rule::unique("products", "serialNumber")],
            "type" => "required",
            "description" => "required",
            'imageURL' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $image = $request->file('imageURL');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Store the image in the storage/app/public directory
        $path = $image->storeAs('public/images', $fileName);

        $incomingFields['imgURL'] = $path;
        $product = new Product($incomingFields);
        $product->save();

        $selectedTags = $request->input('tags');
        $product->tags()->attach($selectedTags);

        $user = auth()->guard('technician')->user();

        if ($user instanceof Technician) {
            // Assign the product to the technician
            $user->products()->attach($product->id);

            // Update the total counts arrays to include the new product type and its count
            $productType = $product->type;
            $totalCount = RegisteredProduct::where('type', $productType)->count();

            // Retrieve the distinct product types
            $productTypes = RegisteredProduct::distinct()->pluck('type')->toArray();

            // Retrieve the total counts for each product type
            $totalCounts = RegisteredProduct::select('type', DB::raw('count(*) as total'))
                ->whereIn('type', $productTypes)
                ->groupBy('type')
                ->pluck('total', 'type')
                ->toArray();

            // Retrieve the total counts for each product type
            $totalTechnicianCounts = Product::select('id', 'type', DB::raw('count(*) as total'))
                ->withCount('technicians')
                ->whereIn('type', $productTypes)
                ->groupBy('id', 'type')
                ->pluck('technicians_count', 'type')
                ->toArray();
        }
        return redirect("/add-product")->with('success', "A Product Has Been Added ");
    }

    public function displayProducts() {
        $products = Product::all();

        // Get the distinct product types from all products
        $productTypes = $products->pluck('type')->unique()->toArray();

        // Initialize counts for all product types
        $totalCounts = array_fill_keys($productTypes, 0);
        $totalTechnicianCounts = array_fill_keys($productTypes, 0);

        // Retrieve the actual counts for each product type
        $registeredProductCounts = RegisteredProduct::select('type', DB::raw('count(*) as total'))
            ->whereIn('type', $productTypes)
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        // Update the counts with the actual counts
        foreach ($registeredProductCounts as $type => $count) {
            $totalCounts[$type] = $count;
        }

        // Retrieve the actual technician counts for each product type
        $registeredTechnicianCounts = Product::select('type', DB::raw('count(*) as total'))
            ->join('product_technician', 'products.id', '=', 'product_technician.product_id')
            ->join('technicians', 'product_technician.technician_id', '=', 'technicians.id')
            ->whereIn('type', $productTypes)
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        // Update the technician counts with the actual counts
        foreach ($registeredTechnicianCounts as $type => $count) {
            $totalTechnicianCounts[$type] = $count;
        }

        return view('register-product', compact('products', 'totalTechnicianCounts', 'totalCounts'));
    }




    //Display only registered Product(for product settings)
    public function displayRegisteredProducts() {
        $registeredProducts = RegisteredProduct::all();

        $productTypes = RegisteredProduct::distinct()->pluck('type')->toArray();
        // Retrieve the total counts for each product type

        $totalTechnicianCounts = Product::select('id', 'type', DB::raw('count(*) as total'))
            ->withCount('technicians')
            ->whereIn('type', $productTypes)
            ->groupBy('id', 'type')
            ->pluck('technicians_count', 'type')
            ->toArray();
        return view('product-settings', compact('registeredProducts', "totalTechnicianCounts"));
    }



    //display all products/techs/and all their registered products for the logged-in user (forhomepage)
    public function displayAllProducts() {
        $technicians = Technician::all();
        $registeredProducts = RegisteredProduct::all();
        $products = Product::all();

        // Get the distinct product types from all products
        $productTypes = $products->pluck('type')->unique()->toArray();

        // Initialize counts for all product types
        $totalCounts = array_fill_keys($productTypes, 0);

        // Retrieve the actual counts for each product type
        $registeredProductCounts = RegisteredProduct::select('type', DB::raw('count(*) as total'))
            ->whereIn('type', $productTypes)
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        // Update the counts with the actual counts
        foreach ($registeredProductCounts as $type => $count) {
            $totalCounts[$type] = $count;
        }

        // Retrieve the total counts for each product type
        $totalTechnicianCounts = Product::select('type', DB::raw('count(*) as total'))
            ->join('product_technician', 'products.id', '=', 'product_technician.product_id')
            ->join('technicians', 'product_technician.technician_id', '=', 'technicians.id')
            ->whereIn('type', $productTypes)
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        foreach ($technicians as $technician) {
            $technicianProducts[$technician->id] = $technician->products()->whereIn('type', $productTypes)->get();
        }

        foreach ($productTypes as $type) {
            if (!isset($totalTechnicianCounts[$type])) {
                $totalTechnicianCounts[$type] = 0;
            }
        }

        return view('index', compact('products', 'registeredProducts', 'totalCounts', 'technicians', 'technicianProducts', 'totalTechnicianCounts'));
    }






    //delete the assigned product of the logged in user
    public function deleteProduct() {
        $userId = auth()->user()->id;
        // Check if the registered product exists for the current user
        $registeredProduct = RegisteredProduct::where('user_id', $userId)->first();
        $registeredProduct->delete();
        return redirect('/')->back()->with("success", "Product Deleted!");
    }


    //assign a new product to logged in user
    public function addNewProduct($id) { {
            // Check if the product is already registered for the current user
            $userId = auth()->user()->id;
            $registeredProduct = RegisteredProduct::where('user_id', $userId)
                ->where('product_id', $id)
                ->first();

            if ($registeredProduct) {
                // Product is already registered, handle accordingly (e.g., show an error message)
                return redirect()->back()->with('failure', 'Product is already registered.');
            }

            // Product is not registered, so register it
            // Retrieve the product from the products table
            $product = Product::find($id);

            // Create a new RegisteredProduct instance
            $registeredProduct = new RegisteredProduct();
            $registeredProduct->user_id = $userId;
            $registeredProduct->product_id = $id;
            $registeredProduct->serialNumber = $product->serialNumber;
            $registeredProduct->type = $product->type;
            $registeredProduct->description = $product->description;
            $registeredProduct->imgURL = $product->imgURL;
            $registeredProduct->save();

            // Redirect the user to the product details page
            return redirect()->back()->with("success", "Product Registered to your account");
        }
    }
}
