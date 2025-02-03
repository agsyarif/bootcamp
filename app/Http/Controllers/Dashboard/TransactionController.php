<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use App\Models\checkout_course;
use App\Models\mutation;
use App\Models\wallet;
use App\Traits\addToCourseAccess;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use addToCourseAccess;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambil data dari tabel checkout_course urutkan berdasarkan tanggal terbaru
        $transactions = checkout_course::orderBy('created_at', 'desc')->get();
        $active = 'transaction';
        // segment untuk mengetahui berasal dari halaman mana yang diakses


        return view('pages.Dashboard.admin.transaction.index', compact('transactions', 'active'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkout = checkout_course::find($id);
        return view('pages.Dashboard.admin.transaction.show', compact('checkout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = checkout_course::find($id);
        $option = [
            '1' => 'pending',
            '2' => 'success',
            '3' => 'cancel',
        ];

        return view('pages.Dashboard.admin.transaction.edit', compact('transaction', 'option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = checkout_course::find($id);
        $transaction->payment_status = $request->status;
        $transaction->save();

        if($request->status == 'success'){
            $this->addToCourseAccess($transaction->id);
        }
        $this->shareProfit($transaction);

        toast()->success('Update has been succes');
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = checkout_course::find($id);
        $transaction->delete();
        // jika asal dari halaman dashboard maka redirect ke halaman dashboard
        if (request()->segment(2) == 'dashboard') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('transaction.index');
        }
    }

    public function shareProfit($checkout)
    {
        $myWallet = wallet::where('wallet_id', 'uwhcamp')->first();
        $toWallet = $checkout->course->user->wallet();
        $shareTo = 70 / 100;

        if (empty($toWallet)) {
            $walletController = new WalletController();
            $toWallet = $walletController->index($checkout->course->user->id);
        }

        // ambil gross-amount dari checkout course
        $grossAmount = $checkout->gross_amount;
        $shareProfit = $grossAmount * $shareTo;
        $myProfit = $grossAmount - $shareProfit;

        // mencatat di mutation 2 transaksi, masuk uwhcamp, keluar uwhcamp
        mutation::create([
            'from_wallet' => 'MEMBER',
            'debet' => $grossAmount,
            'kredit' => 0,
            'to_wallet' => $myWallet->wallet_id,
            'note' => 'CHECKOUT-COURSE-' . $checkout->user_id
        ]);

        mutation::create([
            'from_wallet' => $myWallet->wallet_id,
            'debet' => 0,
            'kredit' => $shareProfit,
            'to_wallet' => $toWallet->wallet_id,
            'note' => 'SHARE-PROFIT-TO' . $toWallet->wallet_id
        ]);
        // update di wallet, uwhcamp masuk & keluar, towallet masuk
        $saldoWallet = $myWallet->saldo + $myProfit;
        $myWallet = wallet::where('wallet_id', 'uwhcamp')->update([
            'saldo' => $saldoWallet
        ]);

        $saldoWallet = $toWallet->saldo + $shareProfit;
        $toWallet = wallet::where('wallet_id', $toWallet->wallet_id)->update([
            'saldo' => $saldoWallet
        ]);
    }
}
