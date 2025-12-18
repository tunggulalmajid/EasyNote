<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramNotifyController extends Controller
{
    public function index (){

        $user = Auth::user();
        $telegram = $user->telegram_chat_id;
        return view('telegram.index', compact('telegram'));
    }

    public function update(Request $request){
         $validated = $request->validate([
            'telegram' => 'required|numeric|min:2'
        ]);

        $user = Auth::user();
        $user -> update([
            'telegram_chat_id' => $validated['telegram']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Telegram ID berhasil disimpan!'
        ]);
    }

    public function destroy(){
         $user = Auth::user();
         $user -> update([
            'telegram_chat_id' => null
        ]);

        return response()->json(['message' => 'Telegram id berhasil dihapus']);
    }
}
