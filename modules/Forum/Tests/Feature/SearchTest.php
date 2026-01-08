<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class SearchTest extends TestCase
{
   use RefreshDatabase;

   public function test_a_user_can_search_in_threads(): void
   {
       config(['scout.driver' => 'algolia']);
       $this->signIn()->withoutExceptionHandling();
        $search = 'foobar';

        create(Thread::class, [], 2);
        create(Thread::class, ['body' => "A thread with the {$search} term."], 2);

        $response = $this->getJson('threads/search?q=' . $search)->json();

        $this->assertCount(2, $response['data']);

        Thread::query()->latest()->take(4)->unsearchable();
   }
}
