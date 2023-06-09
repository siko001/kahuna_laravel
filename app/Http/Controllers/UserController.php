<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller {

    //register
    public function register(RegisterRequest $request) {
        $incomingFields = $request->validate([
            "username" => ["required", "min:4", "max:12", Rule::unique('users', 'username')],
            "email" => ["required", 'email', Rule::unique('users', 'email')],
            "password" => ["required", "min:4",],
            "cpassword" => ["required", "min:4"],
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = new User($incomingFields);
        $user->save();

        if ($user) {
            auth()->login($user);
            return redirect('/')->with('success', "Thank you for creating an account");
        } else {
            redirect('/login')->with('failure', 'something went wrong');
        }
    }

    //login
    public function login(Request $request) {
        $incomingFields = $request->validate([
            "loginUsername" => "required",
            "loginPassword" => "required"
        ]);

        // Clear existing technician session
        if (Auth::guard('technician')->check()) {
            Auth::guard('technician')->logout();
        }

        if (auth()->attempt([
            'username' => $incomingFields['loginUsername'],
            'password' => $incomingFields['loginPassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return redirect('/login')->with('failure', "Invalid Login Credentials");
        }
    }

    //log-out
    public function logout() {
        auth()->logout();
        return redirect('/')->with("success", "Successfully Logged out");
    }


    public function changeProfileSettings(Request $request, User $user) {
        $userData = $user->toArray();

        // Validate the incoming fields
        $incomingFields = $request->validate([
            "username" => [
                "nullable",
                "min:4",
                "max:12",
                Rule::unique('users', 'username')->ignore($user->id)
            ],
            "name" => "nullable|min:3|alpha",
            "surname" => "nullable|min:3|alpha",
            "email" => [
                "nullable",
                "email",
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            "phone_number" => "nullable|numeric"
        ]);

        // Filter out null or empty fields
        $filteredFields = array_filter($incomingFields, function ($value) {
            return !empty($value);
        });


        // Convert the first letter of name and surname to uppercase if they are in lowercase
        if (isset($filteredFields['name'])) {
            $filteredFields['name'] = ucfirst($filteredFields['name']);
        }
        if (isset($filteredFields['surname'])) {
            $filteredFields['surname'] = ucfirst($filteredFields['surname']);
        }
        if (isset($filteredFields['phone_number']) && strpos($filteredFields['phone_number'], '+') === 0) {
            $filteredFields['phone_number'] = '00' . substr($filteredFields['phone_number'], 1);
        }
        // Merge the filtered fields with the existing user data
        $updatedFields = array_merge($userData, $filteredFields);

        // Update the user profile with the merged fields
        $user->update($updatedFields);

        return redirect()->back()->with("success", "Profile Updated");
    }


    public function changePassword(Request $request, User $user) {
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
                return redirect("/profile")->with("success", "Password changed successfully");
            } else {
                return redirect()->back()->with('failure', "New password cannot be the same as the old password");
            }
        } else {
            return redirect()->back()->with('failure', "Invalid Password");
        }
    }


    //Check if the username is avaliable AJAX
    public function checkUsernameAvailability(Request $request) {
        $username = $request->input('username');
        // Check if a user with the given username already exists in the database
        $userExists = User::where('username', $username)->exists();

        return response()->json(['available' => !$userExists]);
    }


    //Check if the email is avaliable AJAX
    public function checkEmailAvailability(Request $request) {
        $email = $request->input('email');
        // Check if a user with the given username already exists in the database
        $emailExists = User::where('email', $email)->exists();

        return response()->json(['available' => !$emailExists]);
    }

    public function getAllUsers() {
        $users = User::all();
        $products = Product::all();
        $userProducts = []; // Initialize an empty array

        foreach ($users as $user) {
            $userProducts[$user->id] = $user->registeredProducts()->get();
        }

        return view("users", compact('users', 'userProducts'));
    }
}
