<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required'
            ], 401);
        }

        $user = Auth::user();

        // Check if user has required role and token abilities
        if (!in_array($user->role, ['admin', 'super admin'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied. Admin privileges required.',
                'user_role' => $user->role
            ], 403);
        }

        // Check token abilities
        if (!$request->user()->tokenCan('admin')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token permissions',
                'required_ability' => 'admin'
            ], 403);
        }

        return $next($request);
    }
}
