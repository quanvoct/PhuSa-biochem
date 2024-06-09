<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Variable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['verified','auth']);
    }

    public function index()
    {
        $pageName = __('Cart');
        $cart = Cart::get();
        return view('cart', compact('cart', 'pageName'));
    }

    public static function get()
    {
        try {
            if (!Session::has('cart')) {
                if (Auth::check()) {
                    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
                    session()->put('cart', $cart);
                    return $cart;
                } else {
                    return false;
                }
            } else {
                return session('cart');
            }
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error(__('Failed to get cart: :error', ['error' => $e->getMessage()]));
        }
    }

    public function add(Request $request)
    {
        try {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $item = CartItem::firstOrNew(['variable_id' => $request->variable_id]);
            $item->cart_id = $cart->id;
            $item->quantity += $request->quantity;
            $item->price = $request->price ?? $item->price;
            $item->options = $request->options ?? $item->options;
            $item->promotion_id = $request->promotion_id ?? $item->promotion_id;
            $item->save();

            //Update session
            Session::put('cart', Auth::user()->cart);
            $response = [
                'status' => 'success',
                'msg' => __('Successfully added :product to cart', ['product' => $item->variable->product->sku . ($item->variable->sub_sku ?? '') . ' - ' . $item->variable->product->name . ($item->variable->name ? ' - ' . $item->variable->name : '')]),
                'cart' => $this->get()
            ];
            if ($request->ajax()) {
                return response()->json($response, 200);
            } else {
                return redirect()->back()->with('response', $response);
            }
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error(__('Failed to add item to cart: :error', ['error' => $e->getMessage()]));
            return null;
        }
    }

    public function update(Request $request)
    {
        try {
            $item = CartItem::whereVariable_id($request->variable_id)->first();
            $msg = '';
            if($item) {
                if(is_numeric($request->quantity) && $request->quantity != 0) {
                    $item->quantity += $request->quantity - $item->quantity;
                    $item->options = $request->options ?? $item->options;
                    $item->promotion_id = $request->promotion_id ?? $item->promotion_id;
                    $item->save();
                    $msg = __('Successfully added :product to cart', ['product' => $item->variable->product->sku . ($item->variable->sub_sku ?? '') . ' - ' . $item->variable->product->name . ($item->variable->name ? ' - ' . $item->variable->name : '')]);
                } else {
                    $item->delete();
                    $variable = Variable::find($request->variable_id);
                    $msg = __('Successfully removed :product from cart', ['product' => $variable->product->sku . ($variable->sub_sku ?? '') . ' - ' . $variable->product->name . ($variable->name ? ' - ' . $variable->name : '')]);
                }
            }

            //Update session
            Session::put('cart', Auth::user()->cart);
            $response = [
                'status' => 'success',
                'msg' => $msg,
                'cart' => $this->get()
            ];
            if ($request->ajax()) {
                return response()->json($response, 200);
            } else {
                return redirect()->back()->with('response', $response);
            }
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error(__('Failed to add item to cart: :error', ['error' => $e->getMessage()]));
            return null;
        }
    }

    public function remove(Request $request)
    {
        try {
            CartItem::whereVariable_id($request->variable_id)->first()->delete();
            $variable = Variable::find($request->variable_id);

            //Update session
            Session::put('cart', Auth::user()->cart);

            $response = [
                'status' => 'success',
                'msg' => __('Successfully removed :product from cart', ['product' => $variable->product->sku . ($variable->sub_sku ?? '') . ' - ' . $variable->product->name . ($variable->name ? ' - ' . $variable->name : '')]),
                'cart' => $this->get()
            ];
            if ($request->ajax()) {
                return response()->json($response, 200);
            } else {
                return redirect()->back()->with('response', $response);
            }
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error(__('Failed to remove item from cart: :error', ['error' => $e->getMessage()]));
        }
    }

    public function clear(Request $request)
    {
        try {
            Auth::user()->cart->items->delete();
            session()->forget('cart');

            $response = [
                'status' => 'success',
                'msg' => __('Successfully cleared cart'),
                'cart' => $this->get()
            ];
            if ($request->ajax()) {
                return response()->json($response, 200);
            } else {
                return redirect()->back()->with('response', $response);
            }
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error(__('Failed to clear cart: :error', ['error' => $e->getMessage()]));
        }
    }
}
