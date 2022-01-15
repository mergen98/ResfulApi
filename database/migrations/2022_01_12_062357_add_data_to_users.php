<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddDataToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for ($i = 0; $i < 50; $i++){
            $faker = Faker\Factory::create();
            $verified = $faker->randomElement([User::VERIFIED_USER,User::UNVERIFIED_USER]);
            \App\Models\User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => \Illuminate\Support\Facades\Hash::make("password"),
                'remember_token' => Str::random(10),
                'verified' => $verified,
                'verified_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
                'admin' => $faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
            ]);
        }

        for ($i = 0; $i < 20; $i++){
            $faker = Faker\Factory::create();
            \App\Models\Category::create([
                'name' => $faker->word(),
                'description' => $faker->paragraph(1),
            ]);
        }

        for ($i = 0; $i < 20; $i++){
            $faker = Faker\Factory::create();
            $name = $faker->word();
            $product = \App\Models\Product::create([
                'name' => $name,
                'slug' => Str::slug($name) . "-". $i,
                'description' => $faker->paragraph(1),
                'quantity' => $faker->numberBetween(1,10),
                'status' => $faker->randomElement([\App\Models\Product::AVAILABLE_PRODUCT,\App\Models\Product::UNAVAILABLE_PRODUCT]),
                'image' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
                'seller_id' => \App\Models\User::all()->random()->id,
            ]);
//            $categories = \App\Models\Category::all()->random(5)->pluck("id")->toArray();
//            $product->categories()->sync($categories);
             $categories = \App\Models\Category::all()->random(mt_rand(1, 5))->pluck('id');
             $product->categories()->attach($categories);
        }
        for ($i = 0; $i < 20; $i++){
            $faker = Faker\Factory::create();
            $seller = \App\Models\Seller::has('products')->get()->random();
            $buyer = \App\Models\User::all()->except($seller->id)->random();
            \App\Models\Transaction::create([
                'quantity' => $faker->numberBetween(1,3),
                'buyer_id' => $buyer->products->random()->id,
                'product_id' => $seller->products->random()->id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
