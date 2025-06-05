<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SupportTicketController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $tickets = auth()->user()->supportTickets()->latest()->paginate(10);
        return view('support_tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('support_tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        auth()->user()->supportTickets()->create($request->all());

        return redirect()->route('support_tickets.index')->with('success', 'Ticket créé avec succès !');
    }

    public function show(SupportTicket $supportTicket)
    {
        $this->authorize('view', $supportTicket);
        return view('support_tickets.show', compact('supportTicket'));
    }

    // Ajoute d’autres méthodes si besoin (edit, update, destroy)
}

