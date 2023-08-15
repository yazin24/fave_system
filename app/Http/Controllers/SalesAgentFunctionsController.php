<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SalesAgentFunctionsController extends Controller
{
    public function view_dashboard()
    {
        return view('salesagent.agent_dashboard');
    }

    public function enter_password(Agents $agent)
    {
        return view('salesagent.agent_password', ['agent' => $agent]);
    }

    public function verify_password(Request $request, $agent)
    {
        $realAgent = Agents::findOrFail($agent);

        if(!$realAgent){
            abort(404);
        }

        $password = $request -> input('password');

        if(Hash::check($password, $realAgent -> agents_password)){
            // dd($realAgent->agents_password);
            return view('salesagent.agent_dashboard', ['agent' => $realAgent]);

        }else {

            return back() -> withErrors(['password' => 'Invalid Password! Please try again.']);

        }
    }
}
