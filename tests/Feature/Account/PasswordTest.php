<?php

//
//declare(strict_types=1);
//
//namespace Feature\Account;
//
//use App\Mail\User\PasswordChangeConfirmationMail;
//use App\Models\User;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Mail;
//use Laravel\Sanctum\Sanctum;
//use Tests\TestCase;
//
//class PasswordTest extends TestCase
//{
//    public User $user;
//
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        $this->user = User::factory()->create();
//        Sanctum::actingAs($this->user);
//    }
//
//    public function test_password_change_from_account()
//    {
//        Mail::fake();
//
//        $this->putJson(route('v1.password-change', $this->user), [
//            'old_password' => 'password',
//            'password' => 'password1234',
//            'password_confirmation' => 'password1234',
//        ])
//            ->assertOk()
//            ->assertJsonStructure(['message']);
//
//        $this->assertTrue(Hash::check('password1234', $this->user->password));
//
//        Mail::assertSent(PasswordChangeConfirmationMail::class, function ($mail) {
//            return $mail->hasTo($this->user->email);
//        });
//
//    }
//}
