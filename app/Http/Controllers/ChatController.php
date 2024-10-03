<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function js(){
    $pathToFile = public_path('assets/js/chatbot-min.js');
    return response()->file($pathToFile, [
        'Content-Type' => 'application/javascript'
    ]);
    }

    public function css(){
    $pathToFile = public_path('assets/css/chat-bot-min.css');
    return response()->file($pathToFile, [
        'Content-Type' => 'text/css'
    ]);
    }
}
