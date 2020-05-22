<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;

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
//           step 1 start transaccion
            DB::beginTransaction();
            try {
                DB::connection('db1')->table('transactions')->insert([
                    'bank_accounts_id' => $bank_accounts->id,
                    'transaction_type_id' => 1,
                    'mount_transaction' => $request->amount,
                    'created_at' => date("Y-m-d H:i:s"),
                ]);

                $bank_amount = DB::connection('db1')->table('bank_accounts')
                    ->where('account_number','=',[$request->account_number])
                    ->select('amount')->get();
                DB::connection('db1')->table('bank_accounts')
                    ->where('account_number',[$request->account_number])
                    ->update(['amount'=>$bank_amount[0]->amount - $request->amount]);
//              step 2  if all good commit
                DB::commit();
            } catch (\Exception $exception) {
//               step 3 if some error rollback
                DB::rollBack();
            }
        }else{
            return redirect()->back()->with('alerta','Monto insuficiente o Cuanta inactiva');
        }
//        return redirect()->route('detail_transaction',['bank_account_id' => $bank_accounts->id])->with('alert','Su pedio fue realizado con exito');
        return redirect()->route('user_orders',['user_id' => Auth::user()->id])->with('alert','Su pedio fue realizado con exito');
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

    public function transactionDetail($bank_account_id){
        $transaction_details = DB::connection('db1')
                               ->table('bank_users')
                               ->join('bank_accounts','bank_accounts.bank_user_id','=','bank_users.id')
                               ->join('transactions','transactions.bank_accounts_id','=','bank_accounts.id')
                               ->join('transaction_types','transactions.transaction_type_id','=','transaction_types.id')
                               ->where('bank_accounts.id',$bank_account_id)
                               ->select('transactions.*','transactions.id','bank_users.*','bank_accounts.*','transaction_types.*')
                               ->get();

        return view('orders.transactionDetail',compact('transaction_details'));
    }
}
