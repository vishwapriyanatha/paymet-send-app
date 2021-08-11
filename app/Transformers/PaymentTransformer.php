<?php


namespace App\Transformers;

use App\Core\Contracts\BaseTransformerInterface;

class PaymentTransformer implements BaseTransformerInterface
{
    private $payment;

    public function __construct($responseData)
    {
        $this->payment = $responseData;
    }

    public function format()
    {
        $return = [];
        foreach ($this->payment as $returnData){
            $return[] = [
                'id' => $returnData->id,
                'amount' => $returnData->amount,
                'claimed' => $returnData->claim,
                'sender_name' => $returnData->senderName->name,
            ];
        }
        return $return;
    }
}
