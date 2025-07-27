<?php

namespace Modules\Forum\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Forum\Domain\Models\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Channel::factory()->count(10)->create();
    }
}
