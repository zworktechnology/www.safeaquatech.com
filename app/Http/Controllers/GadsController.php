<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GadsController extends Controller
{
    public function store(Request $request)
    {
        // Cloudflare Turnstile verification
        $verify = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret'   => config('services.turnstile.secret_key'),
            'response' => $request->input('cf-turnstile-response'),
            'remoteip' => $request->ip(),
        ]);

        if (! ($verify->json('success') ?? false)) {
            return response()->json(['success' => false, 'error' => 'Security check failed. Please try again.'], 422);
        }

        $name   = $request->input('name');
        $phone  = $request->input('phone');
        $area   = $request->input('area');
        $source = $request->input('source');
        $time   = $request->input('time');

        $details = implode(' | ', array_filter([
            'Name: '           . $name,
            'Phone: '          . $phone,
            'Area: '           . $area,
            'Water Source: '   . $source,
            'Preferred Time: ' . $time,
            'Source: Ads Landing Page',
        ]));

        $meta = Http::withToken(config('services.meta_whatsapp.access_token'))
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

        if (! $meta->successful()) {
            return response()->json([
                'success' => false,
                'error'   => 'Sorry, we could not process your request. Please try again.',
            ], 500);
        }

        return response()->json(['success' => true]);
    }
}
