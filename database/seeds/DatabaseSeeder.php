<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ParentsTableSeeder::class);
        $this->call(ChildrenTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(WishesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(HistoryTableSeeder::class);
    }
}
