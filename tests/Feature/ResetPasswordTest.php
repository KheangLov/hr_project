<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function test_submit_password_reset_request()
    {
        Session::start();
        $user = factory(User::class)->create();
        $response = $this
            ->post('/password/email', [
                '_token' => csrf_token(),
                'email' => $user->email,
            ])
            ->assertStatus(302);
    }

    // public function test_user_receives_an_email_with_a_password_reset_link()
    // {

    //     // Mail::fake();

    //     // Perform order shipping...
    //     // Mail::assertSent(User::class, function ($mail) use ($user) {
    //     //     return $mail->user->id === $user->id;
    //     // });

    //     // // Assert a message was sent to the given users...
    //     // Mail::assertSent(User::class, function ($mail) use ($user) {
    //     //     return $mail->hasTo($user->email);
    //     // });

    //     // // Assert a mailable was sent twice...
    //     // Mail::assertSent(User::class, 2);

    //     // // Assert a mailable was not sent...
    //     // Mail::assertNotSent(User::class);
    //     // $this
    //     //     ->followingRedirects()
    //     //     ->from('kheang015@gmail.com')
    //     //     ->post('/password/email', [
    //     //         'email' => 'lovsokheang@gmail.com',
    //     //     ]);
    //     // $response->assertOk();
    //     // dd($response);

    //     // Session::start();
    //     // // Given
    //     // // Notification::fake();
    //     // // $user = User::where('email', 'lovsokheang@gmail.com')->get();
    //     // $user = factory(User::class)->create();

    //     $mailer = new MailFake();
    //     $this->app->instance('mailer', $mailer);

    //     // // When
    //     $user = factory(User::class)->create();
    //     $response = $this->post(
    //         route('password.email'),
    //         [
    //             'email' => $user->email,
    //             '_token' => csrf_token()
    //         ]
    //     );

    //     $mailer->assertSent(User::class, function ($mail) use ($user) {
    //         return $mail->hasTo($user->email);
    //     });
    //     // // Then
    //     // $this->assertNotNull($token = DB::table('password_resets')->first());
    //     // Mail::assertSent(User::class, function ($mail) use ($user) {
    //     //     dd($user);
    //     //     return $mail->hasTo($user->email);
    //     // });
    //     // Notification::assertSentTo($user[0], ResetPassword::class, function ($notification, $channels) use ($token) {
    //     //     return Hash::check($notification->token, $token->token) === true;
    //     // });
    // }
}
