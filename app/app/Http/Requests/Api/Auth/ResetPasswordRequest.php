<?php declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class ResetPasswordRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'token' => ['required', 'string'],
        ];
    }
}
