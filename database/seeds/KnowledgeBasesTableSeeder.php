<?php

use Illuminate\Database\Seeder;

class KnowledgeBasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\KnowledgeBase::class, 300)->create();
    }
}
