<?php

namespace App\Http\Controllers;
use phpseclib3\Crypt\RSA;

use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function decodeClave(Request $request) {
        $clavePublica = $request->clavepublica;
        $clavePublicaPem = "-----BEGIN PRIVATE KEY-----\n";
        $clavePublicaPem .= chunk_split($clavePublica, 64, "\n"); // Añadir saltos de línea cada 64 caracteres
        $clavePublicaPem .= "-----END PRIVATE KEY-----";
    
        // Obtener la clave privada desde el archivo .env
        $clavePrivadaSinCabeceras = env('RSA_PRIVATE_KEY');
        $clavePrivadaPEM = "-----BEGIN PRIVATE KEY-----\n";
        $clavePrivadaPEM .= chunk_split($clavePrivadaSinCabeceras, 64, "\n"); // Añadir saltos de línea cada 64 caracteres
        $clavePrivadaPEM .= "-----END PRIVATE KEY-----";
    
        // Crear el objeto RSA y cargar la clave privada
        $privateKey = RSA::load($clavePrivadaPEM)->withPadding(RSA::ENCRYPTION_PKCS1); // Asegúrate de usar el padding correcto
    
        // Decodificar la clave pública
        try {
            // Decodificar la clave pública (aquí se supone que deberías tener datos cifrados)
            $mensajeDecodificado = $privateKey->decrypt(base64_decode($clavePublicaPem));
    
            // Comprobar si el mensaje decodificado es false
            if ($mensajeDecodificado === false) {
                throw new \Exception("No se pudo descifrar el mensaje.");
            }
    
            // Convertir el mensaje a string si es necesario
            return response()->json([
                'mensaje' => $mensajeDecodificado,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al decodificar: ' . $e->getMessage(),
            ], 500);
        }
    }

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
