<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use App\Services\AuditFormatter;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::with('user')->latest()->paginate(15);

        // transformo cada audit
        $audits->getCollection()->transform(function ($audit) {
            $audit->formatted = AuditFormatter::format($audit);
            $audit->custom_event = AuditFormatter::resolveEvent($audit);
            return $audit;
        });

        return view('audit.index', compact('audits'));
    }
}