<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show()
    {
        $content = view('chatbot')->render();
        return response()->json([
            'iframe' => '<iframe srcdoc="' . htmlspecialchars($content) . '"z-index: 100; width="350" height="550" style="border: unset;border: unset;position: absolute;right: 0;bottom: 0;"></iframe>'
        ]);
    }
}
