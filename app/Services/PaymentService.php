<?php

namespace App\Services;

use App\Contracts\Services\PaymentServiceInterface;
use App\Core\BaseAppService;
use App\Helper\Helper;
use App\Repositories\PaymentRepository;
use \App\Mail\UserCreateEmail;
use \App\Mail\PaymentSendEmail;

class PaymentService extends BaseAppService implements PaymentServiceInterface
{
    /**
     * @var PaymentRepository
     */
    private $payment;

    /**
     * CustomerService constructor.
     * @param PaymentRepository $payment
     */
    public function __construct(PaymentRepository $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function index()
    {
       $user = $this->getUser();
        return $this->payment->index($user->id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $email = $request['email'];
        $amount = $request['amount'];
        $isExsist = $this->payment->getUserByEmail($email);
        $user = $this->getUser();
        $store = [
            'sender_id' => $user->id,
            'amount' => $amount
        ];

        if ($isExsist) {
            $name = $isExsist->name;
            $store['receiver_id'] = $isExsist->id;
        } else {
            $name = Helper::getNameByEmail($email);
            $createUser = $this->payment->createUser($email, $name);
            $store['receiver_id'] = $createUser->id;

            $details = [
                'title' => 'User create email',
                'email' => $email,
                'name' => $name
            ];

            \Mail::to($email)->send(new UserCreateEmail($details));
        }

        $paymentEmail = [
            'title' => 'New payment received',
            'link' => env('APP_URL'),
            'name' => $name,
            'amount' => $amount,
            'sender' => $user->name
        ];

        \Mail::to($email)->send(new PaymentSendEmail($paymentEmail));
        return $this->payment->store($store);
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return \Auth::user();
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function claimAmount($id)
    {
        return $this->payment->claimAmount($id);
    }
}
