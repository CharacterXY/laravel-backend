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
        // Logika za dohvatanje svih korisnika
        // Na primer, mozete koristiti User model da dobijete sve korisnike
        $users = User::all();

        // Vracanje odgovora u JSON formatu
        return response()->json($users);
    }


}
