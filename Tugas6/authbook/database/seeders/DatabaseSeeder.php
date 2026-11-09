<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'role' => User::ROLE_ADMIN,
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff',
                'password' => 'password',
                'role' => User::ROLE_STAFF,
            ]
        );

        User::updateOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Viewer',
                'password' => 'password',
                'role' => User::ROLE_VIEWER,
            ]
        );

        User::query()
            ->where('email', 'admin@gmail.com')
            ->update(['role' => User::ROLE_ADMIN]);

        Author::factory(max(0, 10 - Author::count()))->create();
        $authors = Author::query()->get();

        Book::factory(max(0, 50 - Book::count()))->create([
            'author_id' => fn () => $authors->random()->id,
        ]);

        Book::query()
            ->whereNull('description')
            ->each(fn (Book $book) => $book->update(['description' => fake()->paragraph()]));

        $categories = collect(['Fiction', 'Non-Fiction', 'Science'])
            ->map(fn (string $name) => Category::firstOrCreate(['name' => $name]));

        Book::query()
            ->whereDoesntHave('categories')
            ->each(fn (Book $book) => $book->categories()->attach($categories->random()->id));
    }
}
