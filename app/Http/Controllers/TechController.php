<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TechController extends Controller {
    public function registerTech(Request $request) {
        $incomingFields = $request->validate([
            'fullname' => 'required|min:4',
            'email' => ['required', 'email', Rule::unique('technicians', 'email')],
            'phone' => "required",
            'password' => ['required', 'min:4'],
            'confirm-password' => 'required|min:4|same:password',
            'products' => 'array', // Add validation rule for products array
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $tech = new Technician($incomingFields);

        // Associate the selected products with the technician
        $selectedProducts = $request->input('products');
        $tech->save(); // Save the technician instance first
        $tech->products()->attach($selectedProducts);
        Auth::guard('technician')->login($tech);
        if ($tech) {
            return redirect('/')->with('success', 'Welcome to Kahuna Technician!');
        } else {
            return redirect('/')->with('failure', 'Something went wrong');
        }
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Clear existing user session
        if (auth()->check()) {
            auth()->logout();
        }

        if (Auth::guard('technician')->attempt($credentials)) {
            // Authentication successful
            return redirect('/')->with('success', 'Logged in successfully.');
        } else {
            // Authentication failed
            return redirect()->back()->with('failure', 'Invalid login credentials.');
        }
    }

    public function logout() {
        Auth::guard('technician')->logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }



    public function changeProfileSettings(Request $request) {
        $user = Auth::guard('technician')->user();

        // Retrieve the authenticated user's data
        $userData = $user->getAttributes(); // Get the user attributes as an array


        // Validate the incoming fields
        $incomingFields = $request->validate([
            "fullname" => 'nullable|min:4',
            "email" => [
                "nullable",
                "email",
                Rule::unique('technicians', 'email')->ignore($user->id)
            ],
            "phone" => "nullable|numeric"
        ]);

        // Filter out null or empty fields
        $filteredFields = array_filter($incomingFields, function ($value) {
            return !empty($value);
        });

        ////continue the update technician profile

        if (isset($filteredFields['phone']) && strpos($filteredFields['phone'], '+') === 0) {
            $filteredFields['phone'] = '00' . substr($filteredFields['phone'], 1);
        }

        // Merge the filtered fields with the existing user data
        $updatedFields = array_merge($userData, $filteredFields);

        // Update the user profile with the merged fields
        $user->fill($updatedFields); // Fill the user model with the updated fields
        $user->save();
        return redirect()->back()->with("success", "Profile Updated");
    }



    public function changePassword(Request $request, Technician $user) {
        $incomingFields = $request->validate([
            "currentPassword" => "required",
            "newPassword" => "required|min:4",
            "confirmNewPassword" => "required|min:4|same:newPassword"
        ]);
        // Check if the current password entered by the user matches the one stored in the database
        if (Hash::check($incomingFields['currentPassword'], $user->password)) {
            // Check if the new password is different from the current password
            if ($incomingFields['newPassword'] !== $incomingFields['currentPassword']) {
                // Update the user's password with the new password
                $user->update([
                    'password' => bcrypt($incomingFields['newPassword'])
                ]);
                $user->save();
                return redirect("/profile")->with("success", "Password changed successfully");
            } else {
                return redirect()->back()->with('failure', "New password cannot be the same as the old password");
            }
        } else {
            return redirect()->back()->with('failure', "Invalid Password");
        }
    }


    public function getAllTechs() {
        $technicians = Technician::all();
        $products = Product::all();

        foreach ($technicians as $technician) {
            $technicianProducts = $technician->products()->get();
            $technician->specializations = $technicianProducts;
        }

        return view("all-techs", compact('technicians', "products"));
    }

    public function showSpecializedTechnicians($type) {
        $products = Product::all();
        // Retrieve technicians with the specified specialization type
        $technicians = Technician::whereHas('products', function ($query) use ($type) {
            $query->where('type', $type);
        })->get();

        return view('specialized-technicians', compact('technicians', "type", "products"));
    }


    public function getTechniciansByProduct(Product $product) {
        $technicians = $product->technicians;
        return view('technicians-by-product', compact('technicians', 'product'));
    }
}
