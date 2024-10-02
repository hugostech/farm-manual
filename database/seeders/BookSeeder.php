<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('books')->insert([
            'id' => 1,
            'title' => 'Taxation',
            'subtitle' => 'This section sets out some of the more important requirements for Income Tax, Fringe Benefit Tax and Goods and Services Tax. The law relating to tax in New Zealand includes the Income Tax Act 2007, the Tax Administration Act 1994 and the Goods and Services Tax Act 1985.',
            'author' => $faker->name,
            'cover_image' => 'covers/Taxation-Front-cover.png',
            'status' => 'published',
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('books')->insert([
            'id' => 2,
            'title' => 'Financial Budget Manual',
            'subtitle' => 'Farmers, growers, consultants, and students will find their Financial Budget Manual becomes a valuable planning tool and farmers manual. With all the essential information on farm budgeting and costs, various enterprise profitability and taxation information, you will want the Financial Budget Manual Vol 41 at arm’s reach.',
            'author' => $faker->name,
            'cover_image' => 'covers/Financial-budget-manual-front-page2023-1.png',
            'status' => 'draft',
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('book_to_groups')->insert([
            'book_id' => 1,
            'group_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        for ($i = 1; $i <= 5; $i++) {
            DB::table('catalogs')->insert([
                'id' => $i,
                'title' => 'Chapter '.$i,
                'sort' => $i,
                'book_id' => 1,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
//        for ($i = 1; $i <= 5; $i++) {
//            DB::table('catalogs')->insert([
//                'id' => $i,
//                'title' => 'Chapter '.$i,
//                'sort' => $i,
//                'book_id' => 2,
//                'status' => 'published',
//                'created_at' => now(),
//                'updated_at' => now()
//            ]);
//        }
        for ($i = 1; $i <= 5; $i++) {
            DB::table('pages')->insert([
                'id' => $i,
                'title' => $faker->sentence,
                'url' => $faker->url,
                'context' => $faker->text,
                'sort' => $i,
                'catalog_id' => 1,
                'book_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
