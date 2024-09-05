<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create(['title' => 'Welcome', 'content' => 'Welcome']);
        Page::create(['title' => 'Get Consultations', 'content' => 'Get Consultation']);
    }
}
