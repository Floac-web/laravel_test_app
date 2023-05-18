<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketProductRequest;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class BasketController extends Controller
{
    public function index(Request $request)
    {
        $userProducts = basket()->getToken();

        return view('user.basket.index', compact('userProducts'));
    }
}
