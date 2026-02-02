<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Store a new borrowing request
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'amount' => 'required|integer|min:1',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $item = Item::findOrFail($request->item_id);

        // Check stock availability
        if ($item->stock < $request->amount) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'amount' => $request->amount,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }

    /**
     * Show user's borrowing history
     */
    public function history()
    {
        $borrowings = Borrowing::with('item')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('borrowings'));
    }

    /**
     * Admin: Show all pending requests
     */
    public function adminDashboard()
    {
        $pendingBorrowings = Borrowing::with(['user', 'item'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $allBorrowings = Borrowing::with(['user', 'item'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('pendingBorrowings', 'allBorrowings'));
    }

    /**
     * Admin: Approve a borrowing request
     */
    public function approve($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $item = $borrowing->item;

        // Decrease stock
        if ($item->stock >= $borrowing->amount) {
            $item->decrement('stock', $borrowing->amount);
            $borrowing->update(['status' => 'approved']);
            return back()->with('success', 'Peminjaman disetujui!');
        }

        return back()->with('error', 'Stok tidak mencukupi!');
    }

    /**
     * Admin: Reject a borrowing request
     */
    public function reject($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update(['status' => 'rejected']);

        return back()->with('success', 'Peminjaman ditolak.');
    }

    /**
     * Admin: Mark as returned
     */
    public function returned($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->item->increment('stock', $borrowing->amount);
        $borrowing->update(['status' => 'returned']);

        return back()->with('success', 'Barang telah dikembalikan.');
    }
}
