<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PasswordResetLinkController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        // Validate the email address
        $validateUser = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validateUser->errors(),
            ], 422);
        }

        // Retrieve the user by email
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'We cannot find a user with that email address.',
            ], 404);
        }

        // Check if the user has requested a reset recently
        $lastResetRequest = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if ($lastResetRequest) {
            $lastRequestTime = Carbon::parse($lastResetRequest->created_at);
            $nextAllowedRequestTime = $lastRequestTime->addMinutes(5);

            if ($nextAllowedRequestTime->isFuture()) {
                $remainingTime = $nextAllowedRequestTime->diffForHumans([
                    'parts' => 2,
                    'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
                ]);

                return response()->json([
                    'status' => false,
                    'message' => "You must wait {$remainingTime} before requesting another password reset.",
                ], 429);
            }
        }

        // Generate a password reset token
        $token = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => bcrypt($token), 'created_at' => now()]
        );

        // Notify the user with the reset token
        $user->notify(new CustomResetPasswordNotification($token, $user));

        // Notify the admin (if applicable)
        // $admin = User::find(1);
        // if ($admin) {
        //     $admin->notify(new CustomResetPasswordNotification($token, $user, $admin));
        // }

        return response()->json([
            'status' => true,
            'message' => 'A password reset link has been sent to your email address.',
        ], 200);
    }


}
