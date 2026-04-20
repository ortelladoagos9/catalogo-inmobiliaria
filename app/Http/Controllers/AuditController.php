<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use App\Services\AuditFormatter;

class AuditController extends Controller
{
    public function index()
    {
        $query = Audit::with('user');

        // Filtros
        if (request('date_from')) {
            $query->whereDate('created_at', '>=', request('date_from'));
        }
        if (request('date_to')) {
            $query->whereDate('created_at', '<=', request('date_to'));
        }
        if (request('action')) {
            $query->where('event', request('action'));
        }
        if (request('user')) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . request('user') . '%')
                  ->orWhere('email', 'like', '%' . request('user') . '%');
            });
        }

        $audits = $query->latest()->paginate(15);

        // transformo cada audit
        $audits->getCollection()->transform(function ($audit) {
            $audit->formatted = AuditFormatter::format($audit);
            $audit->custom_event = AuditFormatter::resolveEvent($audit);
            return $audit;
        });

        return view('audit.index', compact('audits'));
    }
}