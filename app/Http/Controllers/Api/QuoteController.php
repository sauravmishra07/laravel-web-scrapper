<?php

namespace App\Http\Controllers\Api;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    /**
     * GET /api/quotes
     * Retrieve all quotes
     */
    public function index()
    {
        $quotes = Quote::all();
        return response()->json($quotes, 200);
    }

    /**
     * POST /api/quotes
     * Store a new quote
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'quote' => 'required|string|min:5',
            'author' => 'required|string|min:2'
        ]);

        // Create and save the quote
        $quote = Quote::create($validated);

        // Return the saved quote
        return response()->json($quote, 201);
    }

    /**
     * GET /api/quotes/{id}
     * Retrieve a single quote by ID
     */
    public function show($id)
    {
        $quote = Quote::find($id);

        if (!$quote) {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        return response()->json($quote, 200);
    }

    /**
     * PUT /api/quotes/{id}
     * Update a quote
     */
    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);

        if (!$quote) {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        $validated = $request->validate([
            'quote' => 'sometimes|string|min:5',
            'author' => 'sometimes|string|min:2'
        ]);

        $quote->update($validated);
        return response()->json($quote, 200);
    }

    /**
     * DELETE /api/quotes/{id}
     * Delete a quote
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);

        if (!$quote) {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        $quote->delete();
        return response()->json(['message' => 'Quote deleted'], 200);
    }
}