<?php

namespace App\Http\Controllers;

use App\Models\DepositOption;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $deposits = $user->deposits()->get();
        return view('DepositIndex', compact('deposits'));
    }

    public function cashInForm($depositId)
    {
        $deposit = Deposit::findOrFail($depositId);
        return view('cashInForm', compact('deposit'));
    }

    public function cashIn(Request $request, $depositId)
    {
        $request->validate([
            'cashInAmount' => 'required|numeric|min:0',
        ], [
            'cashInAmount.min' => 'Amount must be more than 0.'
        ]);

        $deposit   = Deposit::findOrFail($depositId);
        $newAmount = $deposit->amount + $request->cashInAmount;
        $deposit->update(['amount' => $newAmount]);

        return redirect()->route('deposits.index')->with('success','Cash-in successful.');
    }


    public function create()
    {
        $depositOptions = DepositOption::all('id', 'name');
        return view('DepositCreate', compact('depositOptions'));
    }


    public function store(Request $request)
    {
        $request -> validate([
            'amount'            => 'required|numeric|min:0',
            'deposit_option_id' => 'required|exists:deposit_options,id',
        ]);

        Deposit::create([
            'user_id' => auth()->id(),
            'amount'  => $request->amount,
            'deposit_option_id' => $request->deposit_option_id,
            'status' => false,
        ]);

        return redirect()-> route('deposits.index')->with('success', 'Deposit created successfully.');
    }
}
