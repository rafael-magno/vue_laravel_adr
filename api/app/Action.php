<?php

namespace App;

use App\Exceptions\HttpResponseException;
use Lorisleiva\Actions\Action as BaseAction;

abstract class Action extends BaseAction
{
    protected function resolveValidation()
    {
        $this->validator = null;

        if (!$this->passesValidation()) {
            $erros = $this->getValidationErrors();

            throw new HttpResponseException($erros, 422);
        }

        return $this;
    }
}
