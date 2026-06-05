<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Testimonial::create([
            'name' => 'Amara O.',
            'location' => 'Lagos',
            'testimonial' => 'The piping tips set completely transformed my cake decorating.',
            'rating' => 5,
            'avatar_letter' => 'A',
        ]);
        
        Testimonial::create([
            'name' => 'Kemi A.',
            'location' => 'Abuja',
            'testimonial' => 'These are the best cake tins I have ever used.',
            'rating' => 5,
            'avatar_letter' => 'K',
        ]);
        
        Testimonial::create([
            'name' => 'Tolu B.',
            'location' => 'Ibadan',
            'testimonial' => 'Everything was beautifully packaged and delivery was fast.',
            'rating' => 5,
            'avatar_letter' => 'T',
        ]);
    }
}
