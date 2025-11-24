<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.form');
    }

    public function store(Request $request)
    {
        // валидация
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
            'message' => 'required|min:5|max:500',
        ]);

        $data = array_merge($validated, ['timestamp' => now()->toDateTimeString()]);

        $filename = 'feedback_' . uniqid() . '_' . time() . '.json';

        Storage::disk('local')->put('feedbacks/' . $filename, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        return back()->with('success', 'Ваше сообщение успешно сохранено!');
    }

    // список данных
    public function index()
    {
        $files = Storage::disk('local')->files('feedbacks');
        $feedbacks = [];

        foreach ($files as $file) {
            $content = Storage::disk('local')->get($file);
            $json = json_decode($content, true);
            if ($json) {
                $feedbacks[] = $json;
            }
        }
        
        $feedbacks = array_reverse($feedbacks);

        return view('feedback.index', compact('feedbacks'));
    }
}