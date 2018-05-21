<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names  = [
            'bug',
            'feature'
        ];

        foreach ($names as $name) {
            $tag = new \App\Tag();
            $tag->name = $name;
            $tag->save();
        }
    }
}
