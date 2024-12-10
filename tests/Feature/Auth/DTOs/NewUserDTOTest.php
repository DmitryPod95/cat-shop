<?php

declare(strict_types=1);

namespace Auth\DTOs;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class NewUserDTOTest extends TestCase
{
     use RefreshDatabase;

     /**
     *@test
     *@return void
     */
     public function it_instance_created_from_request():void
     {
        $dto = NewUserDTO::fromRequest(new SignUpFormRequest([
            'name' => 'test',
            'email' => 'testing@ya.ru',
            'password' => '123456789'
        ]));

        $this->assertInstanceOf(NewUserDTO::class,$dto);
     }
}
