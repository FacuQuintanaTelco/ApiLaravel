<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show()
    {
        $content = view('chatbot')->render();
        return response()->json([
            'iframe' => '<iframe srcdoc="' . htmlspecialchars($content) . '" width="600" height="400"></iframe>'
        ]);
    }
}
