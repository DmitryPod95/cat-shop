<?php

declare(strict_types=1);

namespace Services\Telegram;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

final class TelegramBotApiTest extends TestCase
{

    /**
     * @test
     * @return void
     */
    public function it_send_message_success(): void
    {
        Http::fake([
            TelegramBotApi::HOST . '*' => Http::response(['ok' => true])
        ]);

        $result = TelegramBotApi::sendMessage('', 1, "Тестинг");

        $this->assertTrue($result);
    }
}
