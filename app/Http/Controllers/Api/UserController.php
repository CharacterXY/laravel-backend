<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // Ovo je kontroler koji ce se koristiti za API endpointove koji ce vracati sve korisnike jer ne koristimo blade engine nakon refresha vec cemo koristiti Vue.js za instant dohvacanje.
    public function index(Request $request)
    {      
        $users = User::all();

        // Vracanje odgovora u JSON formatu
        return response()->json($users);
    }

    
    public function deleteUser(Request $request, $id) {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'message' => 'Korisnik je uspješno obrisan.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Došlo je do greške prilikom brisanja korisnika.',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function showUsersByNumber($number) 
    {
     
        $user = User::take($number)->get();  

        return response()->json($user);
    }

    public function getUserById($id) 
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Korisnik nije pronađen.'], 404);
        }

        return response()->json($user);
    }

    public function updateUser(Request $request, $id) 
    {
        $user = User::findOrFail($id);
    
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:6', 
            'isActive' => 'boolean',
        ]);
    
        if (!empty($validated_data['password'])) {
            $validated_data['password'] = bcrypt($validated_data['password']);
        } else {
            unset($validated_data['password']);  
        }
    
        $user->update($validated_data);
    
        return response()->json([
            'message' => 'Korisnik je uspješno ažuriran.',
            'user' => $user,
        ], 200);
    }
    


}
