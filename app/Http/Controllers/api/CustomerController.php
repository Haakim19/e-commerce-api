<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')
            ->paginate(15);

        return CustomerResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return new CustomerResource($user);
    }
    /**
     * Get orders for specific customer with optional filters
     */
    public function getCustomerOrders(string $userId, Request $request)
    {
        $user = User::with(['orders' => function ($query) use ($request) {
            $query->when($request->status, function ($q, $status) {
                return $q->where('status', $status);
            })->latest();
        }, 'orders.orderItems.product', 'orders.payment'])
            ->findOrFail($userId);

        return new CustomerResource($user);
    }
    /**
     * Get all customer orders with optional filters
     */
    public function getAllCustomerOrders(Request $request)
    {
        $query = User::where('role', 'user')
            ->whereHas('orders', function ($query) use ($request) {
                if ($request->has('status')) {
                    $query->where('status', $request->status);
                }
            })
            ->with(['orders' => function ($query) use ($request) {
                $query->when($request->status, function ($q, $status) {
                    return $q->where('status', $status);
                })
                    ->with(['orderItems.product', 'payment'])
                    ->latest();
            }]);

        $customers = $query->paginate(15);

        if ($customers->isEmpty()) {
            return response()->json([
                'message' => 'No orders found with the specified criteria'
            ], 404);
        }

        return CustomerResource::collection($customers);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
