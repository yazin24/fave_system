<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use Illuminate\Http\Request;

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

    public function verify_password(Request $request, $agentId)
    {
        $realAgent = Agents::findOrfail($agentId);

        if(!$realAgent){
            abort(404);
        }

        $password = $request -> input('password');

        if(password_verify($password, $realAgent -> agent_password)){
            return view('salesagent.agent_dashboard', ['agentId' => $agentId]);
        }else {
            return back() -> withErrors(['password' => 'Invalid Password! Please try again.']);
        }
    }
}
