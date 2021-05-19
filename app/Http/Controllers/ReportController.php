<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $report;
    public function __construct(ReportService $report)
    {
        $this->report = $report;
    }
    public function index()
    {
        $report = $this->report->getReport();
        return view('report.index', compact('report'));
    }
}
