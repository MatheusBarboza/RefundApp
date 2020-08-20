<?php

namespace App\Repositories;

use App\Refund;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RefundRepository {

    /**
     * Get's a refund by it's ID
     *
     * @param int
     * @return collection
     */
    public function find($refund_id)
    {
        return Refund::findOrFail($refund_id);
    }

    /**
     * Get's all refunds.
     *
     * @return mixed
     */
    public function all($status = 0)
    {
        $status = $status == 0 ? '=' : '<>';
        return Refund::where('status', $status, 0)->get();
    }

    /**
     * Create a refund.
     *
     * @param array
     * @return Refund
     */
    public function create(array $data)
    {
        $data['status'] = 0;
        $refund = Refund::create($data);
        foreach ($data['expenses'] as $value) {
            $refund->refundExpenses()->create([ 'expense_id' => $value ]);
        }

        return $refund;
    }

    /**
     * Updates a refund.
     *
     * @param int
     * @param array
     * @return Refund
     */
    public function update($id, array $data)
    {
        try {
            Refund::findOrFail($id)->update($data);
            return;
        } catch (ModelNotFoundException $ex) {
            throw new \Exception ('refund not found', 404);
        }
    }

    /**
     * Deletes a refund.
     *
     * @param int
     */
    public function delete($id)
    {
        try {
            Refund::findOrFail($id)->delete();
        } catch (ModelNotFoundException $ex) {
            throw new \Exception ('refund not found', 404);
        }
    }
}
