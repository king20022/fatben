<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Payment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //



    function dashboard()
    {
        $user = Auth::user();


        return view('user.dashboard', ['user' => $user]);
    }

    public function deposit()
    {
        $user = Auth::user();
        $deposits = $user->deposits;

        // Fetch investments from the database
        $payments = Payment::all();

        return view('user.deposit', [
            'deposits' => $deposits,
            'payments' => $payments, // Pass investments to the view
        ]);
    }


    public function deposits(Request $request)
    {
        // Store a new deposit for the authenticated user
        $user = Auth::user();

        // Validate the request data
        $data = $request->validate([
            'amount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $data['image'] = $image;
        }

        // Create a new deposit for the user
        $deposit = $user->deposits()->create($data);

        return redirect()->route('user.deposit')->with('success', 'Deposit successfully.');
    }


    function withdraw()
    {
        $user = Auth::user();
        $withdrawals = $user->withdrawals;

        return view('user.withdraw', ['withdrawals' => $withdrawals]);
    }

    public function withdraws(Request $request)
    {
        // Store a new withdrawal for the authenticated user
        $user = Auth::user();

        // Validate the request data
        $data = $request->validate([
            'amount' => 'required|numeric',
            'name' => 'required|string',
            'address' => 'required|string',
            'network' => 'required|string',

        ]);


        // Create a new withdrawal for the user
        $withdrawals = $user->withdrawals()->create($data);

        return redirect()->route('user.withdraw')->with('success', 'Withdrawal successfully.');
    }

    function investment()
    {
        $investments = Investment::all();
        return view('user.investment', compact('investments'));
    }



    function deposithistory()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve only the user's deposit transactions
        $deposits = $user->deposits;

        return view('user.deposithistory', compact('deposits'));
    }




    function withdrawalhistory()
    {

        // Get the authenticated user
        $user = Auth::user();

        // Retrieve only the user's deposit transactions
        $withdrawals = $user->withdrawals;


        return view('user.withdrawhistory', compact('withdrawals'));
    }


    public function invest(Investment $investment)
    {
        $user = Auth::user();

        // Check if the user is logged in and has the role of 'user'
        if ($user && $user->role === 'user') {
            // Check if the user's balance is sufficient for the investment
            if ($user->balance >= $investment->min) {
                // Perform the investment action here
                // Deduct the investment amount from the user's balance
                $user->balance -= $investment->min;
                $user->save();

                // Add additional logic for tracking the investment, updating the database, etc.

                return redirect()->back()->with('success', 'Investment successful.');
            } else {
                return redirect()->back()->with('error', 'Insufficient balance for investment.');
            }
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}
