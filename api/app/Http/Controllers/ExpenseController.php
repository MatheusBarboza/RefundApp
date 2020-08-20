<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\Expense\StoreExpense as ExpenseValidator;
use App\Http\Resources\Expense\ExpenseResource;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Expense::all();
        return ExpenseResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseValidator $request)
    {
        try
        {
            $data = $request->validated();
            Expense::create($data);

            return response(['message'  => "created expense"]);
        }
        catch (\Exception $ex) {
            return response(['message' => $ex->getMessage() ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseValidator $request, Expense $expense)
    {
        try {
            $data = $request->validated();
            $expense->update($data);

            $response = [
                'message' => 'updated expense',
            ];

            return response($response);

        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        try {
            $expense->delete($expense->id);

        } catch (\Exception $ex) {
            return response(["message" => $ex->getMessage()], $ex->getCode());
        }

        return response([ 'message' => 'deleted expense' ]);
    }
}
