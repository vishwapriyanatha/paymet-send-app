<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;

interface PaymentServiceInterface extends BaseServiceInterface
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param $request
     * @return mixed
     */
    public function store($request);

    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @param $id
     * @return mixed
     */
    public function claimAmount($id);
}
