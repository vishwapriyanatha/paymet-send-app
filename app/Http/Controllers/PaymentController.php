<?php

namespace App\Http\Controllers;

use App\Core\BaseController;
use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use App\Transformers\UserTransformers;
use App\Transformers\PaymentTransformer;

class PaymentController extends BaseController
{
    private $payment;

    /**
     * @param PaymentService $payment
     */
    public function __construct(PaymentService $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(
            'All payments',
            200,
            (new PaymentTransformer($this->payment->index()))->format());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentRequest $paymentRequest
     * @return mixed
     */
    public function store(PaymentRequest $paymentRequest)
    {
        return $this->successResponse(
            'Payment success',
            200,
            $this->payment->store($paymentRequest->all()));
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->successResponse(
            'Login user',
            200,
            (new UserTransformers($this->payment->getUser()))->format());
    }

    public function claimAmount($id)
    {
        $return = $this->payment->claimAmount($id);
        if ($return) {
            return $this->successResponse(
                'Login user',
                200);
        }else{
            return $this->errorResponse('Error occurred');
        }
    }
}
