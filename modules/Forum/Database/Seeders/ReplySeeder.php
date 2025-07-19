<?php

namespace Modules\Forum\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Forum\Domain\Models\Reply;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reply::factory()->count(50)->create();
    }
}
