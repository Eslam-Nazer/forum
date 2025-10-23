<?php

namespace Modules\Forum\Tests\Unit;

use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Forum\Domain\Services\Spam\Spam;
use Tests\TestCase;

class SpamTest extends TestCase
{
    use DatabaseTransactions;

    public function test_checks_invalid_keywords(): void
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));

        $this->expectException(Exception::class);
        $spam->detect('yahoo customer support');
    }

    public function test_checks_for_any_being_held_down(): void
    {
        $spam = new Spam();

        $this->expectException(Exception::class);
        $spam->detect('Innocent reply aaaaaaaaaaaaaaaa');
    }
}
