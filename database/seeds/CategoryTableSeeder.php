<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $category = new Category();
      $category->name = 'HTML';
      $category->slug = 'html';
      $category->save();

      $category = new Category();
      $category->name = 'CSS';
      $category->slug = 'css';
      $category->save();

      $category = new Category();
      $category->name = 'PHP';
      $category->slug = 'php';
      $category->save();

      $category = new Category();
      $category->name = 'Laravel';
      $category->slug = 'laravel';
      $category->save();
    }
}
