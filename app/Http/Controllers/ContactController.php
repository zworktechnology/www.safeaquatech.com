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


        $data = new Contact();

        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->phone = $request->get('phone');
        $data->subject = $request->get('subject');
        $data->message = $request->get('message');

        $data->save();

        // Live
        $admin_number = 9344330043;

        $name = $request->get('name');
        $clinet_email = $request->get('email');
        $client_phone = $request->get('phone');
        $client_message = $request->get('message');
        $client_subject = $request->get('subject');

        $template = 'Hi%20M/s%20SAFE%20AQUATECH%20-%20Admin%0A%0ANew%20contact%20request%20has%20submitted%20with%20the%20following%20information%0A%0A*Name*%20:%20' . $name . '%0A*Mobile Number*%20:%20' . $client_phone . '%0A*Subject*%20:%20' . $client_subject . '%0A*Message*%20:%20' . $client_message . '%0A%0AGood luck!';


        $access_token_key = '6846b47c20fee';
        $instance_id_key = '6846B62860B93';

        $response = http::post('https://mtechlivedemo.com/api/send?number=91' . $admin_number . '&type=text&message=' . $template . '&instance_id=' . $instance_id_key . '&access_token=' . $access_token_key . '');
        if ($response->successful()) {
            return redirect()->route('redirect');
        } else {
            return redirect()->back();
        }
    }

    protected function validatedData()
    {
        return request()->validate(
            [
                'g-recaptcha-response' => 'required|recaptcha'
            ],
            [
                'g-recaptcha-response.required' => 'Captcha is Required',
            ]
        );
    }

    // public function store(Request $request)
    // {
    //     $data = new Contact();

    //     $data->name = $request->get('name');
    //     $data->email = $request->get('email');
    //     $data->phone_number = $request->get('phone_number');
    //     $data->message = $request->get('message');

    //     $data->save();

    //     $fromnumer = '918098565686';
    //     $number = $data->phone_number;
    //     $mailid = $data->email;
    //     $message = 'Thanks for reaching out our team with the mail id of '.$mailid.' will contact you soon - Zwork Technology.';

    //     $url = 'https://apinew.getitsms.com/send-msg?apikey=jNBGRg6XeUG71uHjqN03TZENSlKxaJ&sender='.$fromnumer.'&receiver=91'.$number.'&message='.$message.'';

    //     return Redirect::to($url)->with('redirectToFunction', true);
    // }
}
