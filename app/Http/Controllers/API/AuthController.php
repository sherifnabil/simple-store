<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function accessToken(UserRequest $request): Response|JsonResponse
    {
        if (! $user = User::where('email', $request->email)->first()) {
            return new Response(
                content: ["message" =>'User does not exist'],
                status: Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (! Hash::check($request->password, $user->password)) {
            return new Response(
                content: ["message" =>'Password mismatch'],
                status: Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user->response = ['token' => $user->createToken('some token')->accessToken];

        return new JsonResponse(
            data: new UserResource(
                resource: $user
            ),
            status: Response::HTTP_OK
        );
    }

    public function logout(Request $request): Response
    {
        $token = $request->user()->token();
        $token->revoke();

        return new Response(
            content: [
                'message' => 'You have been successfully logged out!'
            ],
            status: Response::HTTP_OK
        );
    }
}
