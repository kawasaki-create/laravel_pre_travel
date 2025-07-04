<?php declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

final class ResetPasswordController extends Controller
{
    /**
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        $credentials = request()->only(['email', 'token', 'password']);

        $status = Password::reset($credentials, function (User $user, string $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => trans($status),
            ]);
        }

        return new JsonResponse([
            'message' => trans($status),
        ]);
    }
}
