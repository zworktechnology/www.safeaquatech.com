<?php

namespace App\Http\Controllers;

use App\Models\Dealership;
use Illuminate\Http\Request;

class DealershipController extends Controller
{
    public function store(Request $request)
    {
        $data = new Dealership();

        $data->name = $request->get('name');
        $data->company_name = $request->get('company_name');
        $data->office_address = $request->get('office_address');
        $data->work_area = $request->get('work_area');
        $data->date_of_birth = $request->get('date_of_birth');
        $data->weeding_date = $request->get('weeding_date');
        $data->phone_number = $request->get('phone_number');
        $data->whats_app = $request->get('whats_app');
        $data->interested_in = $request->get('interested_in');

        $data->save();

        return redirect()->route('index');
    }
}
