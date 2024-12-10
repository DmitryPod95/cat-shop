<?php

declare(strict_types=1);

namespace Auth\Actions;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RegisterNewUserActionTest extends TestCase
{
     use RefreshDatabase;

     /**
     *@test
     *@return void
     */
     public function it_success_user_created():void
     {
         $this->assertDatabaseMissing('users', [
             'email' => 'testing@ya.ru',
         ]);

         $action = app(RegisterNewUserContract::class);

         $action(NewUserDTO::make('Test', 'testing@ya.ru', '123456789'));

         $this->assertDatabaseHas('users', [
             'email' => 'testing@ya.ru',
         ]);
     }
}
