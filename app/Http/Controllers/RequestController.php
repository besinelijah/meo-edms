<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendDocumentRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Request/Index');
    }

    public function emailRequest()
    {
        return Inertia::render('Admin/Request/EmailRequest');
    }

    public function sendEmail(SendDocumentRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $emails = array_map('trim', preg_split('/[,;]\s*/', $validatedData['recepientsEmailAddress']));
            $mailInfo = [
                'subject' => $validatedData['subject'],
                'data' => [
                    'message' => $validatedData['message'],
                ],
                'template' => 'mail.document_request'
            ];

            // Loop through each valid email address and send the email
            foreach ($emails as $email) {
                Mail::to($email)->send(new Email($mailInfo));
            }

            return redirect()->back()
                ->withToast('success', "Email has been sent!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withToast('error', "Email sending failed!");
        }
    }
}