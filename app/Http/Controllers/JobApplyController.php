<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WhatsappService;

class JobApplyController extends Controller
{
    public function applyJob(Request $request)
    {
        // Validation
        $request->validate([
            'job_title' => 'required|string',
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|digits:10',
        ]);

        // 👉 Job apply logic (DB insert etc.)
        // JobApplication::create([...]);

        // 👉 WhatsApp Alert
        $whatsappResponse = WhatsappService::sendJobApplyAlert(
            $request->phone,
            $request->job_title,
            $request->name,
            $request->email,
            $request->phone
        );

        return response()->json([
            'status'  => true,
            'message' => 'Job applied successfully & WhatsApp alert sent',
            'whatsapp_response' => $whatsappResponse
        ]);
    }
}
