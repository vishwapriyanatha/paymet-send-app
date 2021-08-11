<?php


namespace App\Transformers;

use App\Core\Contracts\BaseTransformerInterface;
use Illuminate\Http\Response;

class UserTransformers implements BaseTransformerInterface
{
    private $user;

    public function __construct($responseData)
    {
        $this->user = $responseData;
    }

    public function format()
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name
        ];
    }
}
