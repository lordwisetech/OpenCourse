<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
class DashboardController extends BaseController   // ✅ Ensure it extends Controller
 // ✅ Ensure it extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ✅ This should work now
    }

    public function index()
    {
        $user = Auth::user(); // Get logged-in user
        return view('dashboard', compact('user'));
    }
}
