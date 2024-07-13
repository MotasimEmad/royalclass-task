<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'report_content' => 'required',
                'post_id' => 'required'
            ], [
                'report_content.required' => 'Content is required.',
                'post_id' => 'Post is required'
            ]);

            if ($validator->fails()) {
                return response()->error($validator->errors()->first(), 400);
            }

            $report = new Report();
            $report->user_id = auth()->user()->id;
            $report->post_id = $request->post_id;
            $report->report_content = $request->report_content;
            $report->save();

            return response()->success('Report has been added successfully');
        } catch (\Throwable $exception) {
            return response()->error($exception->getMessage(), 500);
        }
    }
}
