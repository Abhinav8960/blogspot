<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:25',
                'email' => 'required|email|max:50',
                'phone' => 'required|string|max:10',
                'subject' => 'nullable|string|max:255',
                'message' => 'nullable|string',
            ]);

            \App\Models\Quote::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Quote submitted successfully!'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }
}
