<?php

namespace Modules\Forum\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Forum\Domain\Models\Thread;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thread::factory()->count(10)->create();
    }
}
