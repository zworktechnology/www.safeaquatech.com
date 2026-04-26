<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::orderBy('id', 'desc')->get();

        return view('pages.backend.contact.index', compact('data'));
    }

    public function store(Request $request)
    {
        // Cloudflare Turnstile server-side verification
        $turnstileToken = $request->input('cf-turnstile-response');
        $verify = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret'   => config('services.turnstile.secret_key'),
            'response' => $turnstileToken,
            'remoteip' => $request->ip(),
        ]);

        if (! ($verify->json('success') ?? false)) {
            return redirect()->back()->withInput()->withErrors(['captcha' => 'Security check failed. Please try again.']);
        }

        $data = new Contact();

        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->phone = $request->get('phone');
        $data->subject = $request->get('subject');
        $data->message = $request->get('message');

        $data->save();

        $details = implode(' | ', array_filter([
            'Name: '    . $request->get('name'),
            'Phone: '   . $request->get('phone'),
            'Email: '   . $request->get('email'),
            'Subject: ' . $request->get('subject'),
            'Message: ' . $request->get('message'),
            'Source: Contact Us Form',
        ]));

        $sent = $this->sendMetaAlert($details);

        if (! $sent) {
            return redirect()->back()->withInput()->withErrors([
                'submit' => 'Sorry, we could not process your request. Please try again.',
            ]);
        }

        return redirect()->route('redirect');
    }

    protected function sendMetaAlert(string $details): bool
    {
        $response = Http::withToken(config('services.meta_whatsapp.access_token'))
            ->post('https://graph.facebook.com/v20.0/' . config('services.meta_whatsapp.phone_number_id') . '/messages', [
                'messaging_product' => 'whatsapp',
                'to'                => config('services.meta_whatsapp.admin_number'),
                'type'              => 'template',
                'template'          => [
                    'name'     => 'website_form_admin_alert',
                    'language' => ['code' => 'en_US'],
                    'components' => [
                        [
                            'type'       => 'body',
                            'parameters' => [
                                ['type' => 'text', 'text' => $details],
                            ],
                        ],
                    ],
                ],
            ]);

        return $response->successful();
    }
}
