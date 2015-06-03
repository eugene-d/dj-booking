<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest {
    private $responseErrorCode = 422;

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Custom realization of response method to avoid redirect and always return JSON response object
     * @param array $errors
     * @return $this|JsonResponse
     */
    public function response(array $errors) {
        return new JsonResponse(['status' => $this->responseErrorCode, 'errors' => $errors], $this->responseErrorCode);
    }
}
