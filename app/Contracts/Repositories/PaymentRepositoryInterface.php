<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;

interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $userId
     * @return mixed
     */
    public function index($userId);

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @param $id
     * @return mixed
     */
    public function claimAmount($id);
}
