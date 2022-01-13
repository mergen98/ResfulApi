<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\CollectionAdd;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
//
//        User::truncate();
//        Category::truncate();
//        Product::truncate();
//        Transaction::truncate();
//        DB::table('category_product')->truncate();
//
//        $userQuantity = 200;
//        $categoryQuantity = 30;
//        $productQuantity = 1000;
//        $transactionQuantity = 1000;
//
//        $factory(User::class,$userQuantity)->create();
//        $factory(Category::class,$categoryQuantity)->create();
//        $factory(Product::class,$productQuantity)->create()->each(
//            function ($product) {
//                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
//                $product->categories()->attach($categories);
//            });
//        $factory(Transaction::class,$transactionQuantity)->create();

    }
}
