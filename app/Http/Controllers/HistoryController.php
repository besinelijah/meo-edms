<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\History;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HistoryController extends Controller
{
    protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function index(Request $request) {
        $page = $request->page ?? 1;
        $records = $this->history->histories(5, true, $page);
        
        return Inertia::render('Admin/History/Index', [
            'records' => $records
        ]);
    }
}
