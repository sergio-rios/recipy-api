<?php

namespace App\Http\Controllers;

use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Create a new PostController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function users()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.users', [
            'users' => $users
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
