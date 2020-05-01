<?php

namespace App;

use App\Exceptions\HttpResponseException;
use Lorisleiva\Actions\Action as BaseAction;
use Illuminate\Http\Response;

abstract class Action extends BaseAction
{
    protected function resolveValidation()
    {
        $this->validator = null;

        if (!$this->passesValidation()) {
            $errors = $this->getValidationErrors();

            throw new HttpResponseException($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this;
    }
}
