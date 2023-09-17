<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Fee_loan;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Loan::all()->where('user_id',Auth::user()->id);

        if ($credits->count() > 0) {
            return redirect()->route('credits.show',['credit' => $credits->first()->id]);
        }else{
            return redirect()->route('credit')->with('No hay creditos');
        }
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
        $request->validate([
            'loan_value' => 'required',
            'loan_value' => 'required',
            'fee' => 'required',
            'interest' => 'required',
            'monthly_interest' => 'required',
            'total_interest' => 'required',
            'total_to_pay' => 'required'
        ]);

        $credit = new Loan;
        $credit->name_loan = "Default";
        $credit->value_loan = $request->loan_value;
        $credit->number_fee = $request->fee;
        $credit->value_interest = $request->interest;
        $credit->monthly_interest = $request->monthly_interest;
        $credit->total_interest = $request->total_interest;
        $credit->total_to_pay = $request->total_to_pay;
        $credit->user_id = Auth::user()->id;
        $credit->save();

        return redirect()->route('credits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Loan::find($id);
        $fees = Fee_loan::all()->where('loan_id',$id);
        $credits = Loan::all()->where('user_id',Auth::user()->id);
        
        $var=0;
        $total=0;
        if ($detail->count() > 0) {
            $value_loan = $detail->value_loan;
            $value_fee = $detail->value_loan / $detail->number_fee;
            $total = 0;
            $var=[];
            $total_interest = 0;
            for ($i=1; $i <= $detail->number_fee; $i++) {
                $value_interest[$i] = ($value_loan * $detail->value_interest) / 100;
                $var[$i] = $value_interest[$i] + $value_fee;
                $value_loan -= $value_fee;
                $total += $var[$i];
                $total_interest += $value_interest[$i];
            }

            $detail->total_interest = $total_interest;
            $detail->total_to_pay = $total;
            $detail->save();
        }

        return view('credit.detail.index', [
            'details' => $detail, 
            'credits' => $credits, 
            'var' => $var, 
            'value_interest' => $value_interest, 
            'value_fee' => $value_fee, 
            'total' => $total,
            'fees' => $fees
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit = Loan::find($id);
        $credit->delete();

        return redirect()->route('credits.index');
    }
}
