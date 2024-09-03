<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Tag::create([
            'name'  => 'Politics',
            'slug' => 'politics',
        ]);
        Tag::create([
            'name'  => 'Finance',
            'slug' => 'finance',
        ]);
        Tag::create([
            'name'  => 'English Premier League',
            'slug' => 'english-premier-league',
        ]);
        Tag::create([
            'name'  => 'Science',
            'slug' => 'science',
        ]);
        Tag::create([
            'name'  => 'Technology',
            'slug' => 'technology',
        ]);
        Tag::create([
            'name'  => 'Health',
            'slug' => 'health',
        ]);
        Tag::create([
            'name'  => 'Education',
            'slug' => 'education',
        ]);
        Tag::create([
            'name'  => 'Sports',
            'slug' => 'sports',
        ]);
        Tag::create([
            'name'  => 'Entertainment',
            'slug' => 'entertainment',
        ]);
        Tag::create([
            'name'  => 'Travel',
            'slug' => 'travel',
        ]);
        Tag::create([
            'name'  => 'Lifestyle',
            'slug' => 'lifestyle',
        ]);
        Tag::create([
            'name'  => 'Food',
            'slug' => 'food',
        ]);
        Tag::create([
            'name'  => 'Fashion',
            'slug' => 'fashion',
        ]);
        Tag::create([
            'name'  => 'Environment',
            'slug' => 'environment',
        ]);
        Tag::create([
            'name'  => 'Music',
            'slug' => 'music',
        ]);
        Tag::create([
            'name'  => 'Art',
            'slug' => 'art',
        ]);
        Tag::create([
            'name'  => 'History',
            'slug' => 'history',
        ]);
        Tag::create([
            'name'  => 'Real Estate',
            'slug' => 'real-estate',
        ]);
        Tag::create([
            'name'  => 'Automotive',
            'slug' => 'automotive',
        ]);
        Tag::create([
            'name'  => 'Cryptocurrency',
            'slug' => 'cryptocurrency',
        ]);
        Tag::create([
            'name'  => 'Gaming',
            'slug' => 'gaming',
        ]);
    }
}
