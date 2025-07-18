<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Registracija novih korisnika
    // trebamo catch block radi exceptiona jer naprimjer necemo vidjeti gresku u JSONU u postmanu ako nesto krivo saljemo 
    public function registerNewUser(Request $request) {
        try {
            $validated_data = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            $user = User::create([
                'name' => $validated_data['name'],
                'lastname' => $validated_data['lastname'],
                'username' => $validated_data['username'], 
                'email' => $validated_data['email'],
                'address' => $validated_data['address'],
                'phone' => $validated_data['phone'],
                'password' => Hash::make($validated_data['password']),
                'role' => 'user',
                //'isActive' => 1,
            ]);
    
            return response()->json([
                'message' => 'Korisnik je uspješno registriran.',
                'user' => $user,
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Došlo je do greške prilikom registracije.',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function login(Request $request) {
        // Prvovjeriti da li postoji korisnik sa tim email-om
        if(User:: where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
            // Provjeriti da li je korisnik admin
            // Provjeriti da li je unesena lozinka ispravna
     

            if(Hash::check($request->password, $user->password)) {
                // Ako je lozinka ispravna, vratiti korisnika

             
            
                return response()->json([
                    'message' => 'Uspješno ste se prijavili.',
                    'user' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'role' => $user->role,
                        'isActive' => $user->isActive,
                        'name' => $user->name,
                        'lastname' => $user->lastname,
                 
                    ],
               
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Neispravna lozinka.',h
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Korisnik sa tim email-om ne postoji.',
            ], 404);
        }


    }
    
    
}
