<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000',
            ]);

            $apiKey = env('OPENROUTER_API_KEY', 'v1-57c163b49eab14d564ef59fbfd6b3b094c3d2f1547433a19d011471ac32bd621');
            $model = env('OPENROUTER_MODEL', 'openai/gpt-3.5-turbo');

            if (!$apiKey) {
                return response()->json([
                    'error' => 'OpenRouter API key not configured'
                ], 500);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => $request->getSchemeAndHttpHost(),
                'X-Title' => 'Laravel Chatbot',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $request->message
                    ]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            if (!$response->successful()) {
                Log::error('OpenRouter API Error: ' . $response->body());
                return response()->json([
                    'error' => 'Failed to get response from AI service'
                ], 500);
            }

            $data = $response->json();
            $aiMessage = $data['choices'][0]['message']['content'] ?? 'Sorry, I could not process your request.';

            return response()->json([
                'message' => trim($aiMessage)
            ]);

        } catch (\Exception $e) {
            Log::error('Chat Controller Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while processing your request'
            ], 500);
        }
    }
}
