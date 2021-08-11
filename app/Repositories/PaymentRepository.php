<?php

namespace App\Repositories;

use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Core\BaseRepository;
use App\Entities\Payment;
use App\Entities\User;
use PHPUnit\Exception;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var User
     */
    private $user;

    /**
     * PaymentRepository constructor.
     * @param Payment $payment
     * @param User $user
     */
    public function __construct(
        Payment $payment,
        User $user
    )
    {
        $this->payment = $payment;
        $this->user = $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        return $this->payment
            ->where('receiver_id', $id)
            ->with('senderName')
            ->get();
    }

    /**
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        try {
            return $this->payment
                ->create($request);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function createUser($email, $name)
    {
        $currentDate = \Carbon\Carbon::now();
        $createUser = [
            'email' => $email,
            'password' => \Hash::make($email),
            'name' => $name,
            'email_verified_at' => $currentDate->toDateTimeString()
        ];

        return $this->user->create($createUser);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function claimAmount($id)
    {
        try {
            return $this->payment->where('id', $id)
                ->update(['claim' => 1]);
        } catch (Exception $exception) {
            return false;
        }

    }
}
