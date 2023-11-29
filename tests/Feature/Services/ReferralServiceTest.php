<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\User;
use App\Services\Internal\ReferralService;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ReferralServiceTest extends TestCase
{
    public User $referrer;

    public User $referral;

    protected function setUp(): void
    {
        parent::setUp();

        $this->referrer = User::where('name', 'Referrer')->first();
        $this->referral = User::where('name', 'Referral')->first();
    }

    /**
     * @test
     *
     * @testdox it generate code
     *
     * @return void
     */
    public function itGenerateCode()
    {
        $expected = base64_encode(json_encode(['user_id' => $this->referrer->id]));
        $actual = ReferralService::generateReferralCode($this->referrer);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     *
     * @testdox it retrieve data from code
     *
     * @return void
     */
    public function itRetrieveDataFromCode()
    {
        $code = ReferralService::generateReferralCode($this->referrer);

        $data = ReferralService::getReferralDataFromCode($code);

        $this->assertNotNull($data['user_id']);
        $this->assertNotEquals(2, $data['user_id']);
        $this->assertEquals($this->referrer->id, $data['user_id']);
    }

    /**
     * @test
     *
     * @testdox it assign referrer role and create referral program
     */
    public function itCreateReferralProgram(): void
    {
        $roleName = 'referrer';
        $this->referrer->update(['referral_percent' => 0, 'referral_discount' => 0]);

        $this->artisan('give:role')
            ->expectsQuestion('What role would you like to assign to the user?', $roleName)
            ->expectsQuestion('Please type owner name or email', $this->referrer->email)
            ->expectsQuestion('Referral percent', '1')
            ->expectsQuestion('Referral discount', '1')
            ->expectsConfirmation('Are your sure?', 'yes')
            ->assertExitCode(0);

        $this->assertDatabaseHas('users', [
            'email' => 'first@gmail.com',
            'referral_percent' => 1,
            'referral_discount' => 1,
            'name' => 'Referrer',
        ]);

        $this->assertTrue($this->referrer->hasRole($roleName));

        $this->artisan('give:role')
            ->expectsQuestion('What role would you like to assign to the user?', $roleName)
            ->expectsQuestion('Please type owner name or email', $this->referrer->email)
            ->expectsOutput('ERROR: This user already assigned to role!')
            ->assertExitCode(0);

        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $this->referrer->id,
            'role_id' => Role::where('name', $roleName)->first()->id,
        ]);

        $this->assertEquals(1, $this->referrer->roles()->count());
    }

    /**
     * @test
     *
     * @testdox it create special referral program with referral discount
     */
    public function itCreateSpecial(): void
    {
        $roleName = 'referral';
        $this->referrer->assignRole('referrer');
        $this->referral->update(['referral_percent' => 0, 'referral_discount' => 0]);

        $customReferralPercent = '0.50';
        $referralDiscount = '1.00';

        $this->artisan('give:role')
            ->expectsQuestion('What role would you like to assign to the user?', $roleName)
            ->expectsChoice(
                'Please choice referrer',
                $this->referrer->email,
                ["{$this->referrer->email} {$this->referrer->name}"]
            )
            ->expectsQuestion('Please type referral name or email', $this->referral->email)
            ->expectsConfirmation("{$this->referral->email} {$this->referral->name}", 'yes')
            ->expectsQuestion('Enter the special referral percent', $customReferralPercent)
            ->expectsQuestion('Referral discount', $referralDiscount)
            ->expectsConfirmation('Are your sure?', 'yes')
            ->assertExitCode(0);

        $this->referral->refresh();
        $this->assertTrue($this->referral->hasRole($roleName));
        $this->assertEquals($customReferralPercent, $this->referral->referral_percent);
        $this->assertEquals($referralDiscount, $this->referral->referral_discount);
        $this->assertEquals($this->referrer->id, $this->referral->referrer_id);
    }
}
