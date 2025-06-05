<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;

class UserExportController extends Controller
{
    public function export($format, Request $request)
    {
        $users = User::all(); // tu peux réutiliser les filtres ici si tu veux

        if ($format === 'csv') {
            return Excel::download(new UsersExport($users), 'utilisateurs.csv');
        }

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('admin.users.export_pdf', compact('users'));
            return $pdf->download('utilisateurs.pdf');
        }

        return back()->with('error', 'Format non supporté.');
    }
}
