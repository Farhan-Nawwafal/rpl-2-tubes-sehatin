<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\Users;
use Carbon\Carbon;

class JournalController extends Controller
{
    public function render(Request $request)
    {
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->first()->id;
        $journals = Journal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('app.journal', compact('journals'));
    }

    public function createJournal(Request $request)
    {
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->value('id');

        $dateNow = Carbon::now()->format('Y-m-d');
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'mood' => 'required|string',
        ]);

        Journal::create([
            'title' => $request->title,
            'description' => $request->description,
            'mood' => $request->mood,
            'date' => $dateNow,
            'user_id' => $userId,
        ]);

        return redirect()->route('journal')->with(['success' => 'Berhasil membuat reminder!']);
    }

    public function editJournal(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'mood' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Cari Journal berdasarkan ID dan User ID
        $username = $request->session()->get('username');
        $userId = Users::where('username', $username)->value('id');
        $journal = Journal::where('id', $id)->where('user_id', $userId)->firstOrFail();

        // Update Data
        $journal->update([
            'title' => $request->title,
            'mood' => $request->mood,
            'description' => $request->description,
        ]);

        return redirect()->route('journal')->with(['success', 'Journal berhasil diupdate!']);
    }
}
