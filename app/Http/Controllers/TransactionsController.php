<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $amount = $request->amount;
        $bank_accounts = DB::connection('db1')->table('bank_accounts')
                                                    ->where('account_number','=',[$request->account_number])
                                                    ->where('active','=',1)
                                                    ->where('amount', '>=' ,[$request->amount])
                                                    ->select('bank_accounts.id')
                                                    ->first();
        if ($bank_accounts){
            // return response()->json(true);
            DB::connection('db1')->table('transactions')->insert([
                // $transactions = new Transactions();
                'bank_accounts_id' => $bank_accounts->id,
                'transaction_type_id' => 1,
                'mount_transaction' => $request->amount,
                'created_at' => date("Y-m-d H:i:s"),
                // $request->amount -$bank_accounts->mount_transaction
                // $transactions->save();
            ]);
        }else{
            return response()->json(false);
            // return ('no tiene monto suficiente');
        }
        return redirect()->route('home');
//        return response()->json($bank_account_array);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
