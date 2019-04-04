<?php

namespace App\Http\Controllers;

use App\Mayday;
use App\Jobs\MessagePIN;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MaydayController extends Controller
{

    public function index()
    {
        // TODO
    }

    public function create()
    {
        return view('mayday.create');
    }

    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'phone_number' => 'required|phone:US'
        ]);
    
        //TODO ensure switch to +44 for the number
    
        $mayday = Mayday::create([
            'phone_number' => $valid_data['phone_number']
        ]);
        
        dispatch_now(new MessagePIN($mayday));
    
        return view('mayday.sent', ['mayday' => $mayday]);
    }

    public function show(Mayday $mayday)
    {
        return view('mayday.page', ['mayday' => $mayday]);
    }

    public function track(Mayday $mayday)
    {
        return view('mayday.track', ['mayday' => $mayday]);
    }

    public function updateLocation(Request $request, Mayday $mayday)
    {
        $mayday->update([
            'last_contact_at' => Carbon::now(),
            'last_location' => $request->all(),
            'last_latitude' => $request->get('latitude'),
            'last_longitude' => $request->get('longitude'),
        ]);
    
        return response('OK',200);
    }

    public function updateConnection(Request $request, Mayday $mayday)
    {
        $mayday->update([
            'last_contact_at' => Carbon::now(),
            'last_connection' =>  $request->all()
        ]);
    
        return response('OK',200);
    }

}
