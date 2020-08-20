<?php

namespace App\Http\Controllers;

use App\Http\Requests\Refund\StoreRefund as RefundValidator;
use App\Http\Requests\Refund\ApproveRefund;
use App\Http\Resources\Refund\RefundResource;
use App\Refund;
use App\Repositories\RefundRepository;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * @var RefundRepository
     */
    protected $repository;

    public function __construct(RefundRepository $repository)
    {
        $this->repository = $repository;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request)
    {
        $data = $this->repository->all($request->status);
        return RefundResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefundValidator $request)
    {
        try {
            $data = $request->validated();
            $data = $this->repository->create($data);

            return response(['message'  => "created refund"]);
        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage() ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function show(Refund $refund)
    {
        $refund->expenses;
        return new RefundResource($refund);
    }

    /**
     * Approve or reject the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function update(ApproveRefund $approve, Refund $refund)
    {
        try {
            $data = $approve->validated();
            $this->repository->update($refund->id, $data);

            $response = [
                'message' => 'updated refund',
            ];

            return response($response);

        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refund $refund)
    {
        try {
            $this->repository->delete($refund->id);
            return response([ 'message' => 'deleted refund' ]);
        } catch (\Exception $ex) {
            return response(["message" => $ex->getMessage()], $ex->getCode());
        }
    }
}
