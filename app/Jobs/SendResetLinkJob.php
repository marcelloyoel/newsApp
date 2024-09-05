<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class SendResetLinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        Log::info('(Jobs)Creating SendResetLink job with: ' . $user->name);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    // public function handle()
    // {
    //     try {
    //         // Generate a reset token
    //         $token = Password::createToken($this->user);

    //         // Generate the password reset link using URL helper
    //         $resetLink = URL::temporarySignedRoute(
    //             'password.reset',
    //             now()->addMinutes(60),
    //             ['token' => $token, 'email' => $this->user->email]
    //         );
    //         Log::info('Link-nya: ' . $resetLink);
    //         // Send the reset link via email (make sure your mail setup is correct)
    //         $status = Password::sendResetLink([
    //             'email' => $this->user->email,
    //         ]);

    //         if ($status === Password::RESET_LINK_SENT) {
    //             Log::info('Reset link sent to: ' . $this->user->email);
    //         } else {
    //             Log::error('Reset link could not be sent to: ' . $this->user->email);
    //         }
    //     } catch (\Exception $e) {
    //         // Log the exception message if something goes wrong
    //         Log::error('Error sending reset link to ' . $this->user->email . ': ' . $e->getMessage());
    //     }
    // }
    public function handle()
    {
        try {
            $token = Password::createToken($this->user);

            $url = URL::temporarySignedRoute(
                'password.reset',
                now()->addMinutes(60),
                ['token' => $token, 'email' => $this->user->email]
            );
            Mail::to($this->user->email)->send(new ResetPasswordMail($url));

            Log::info('Reset link sent to: ' . $this->user->email);
            Log::info('Finished');
        } catch (\Exception $e) {
            Log::error('Error sending reset link: ' . $e->getMessage());
        }
    }
}
