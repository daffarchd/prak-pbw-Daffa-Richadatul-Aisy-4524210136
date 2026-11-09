<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_creates_demo_roles_library_data_and_categories_idempotently(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 3);
        $this->assertDatabaseCount('authors', 10);
        $this->assertDatabaseCount('books', 50);
        $this->assertDatabaseCount('categories', 3);
        $this->assertSame(0, Book::whereNull('description')->count());
        $this->assertSame(50, Book::has('categories')->count());

        $admin = User::where('email', 'admin@example.com')->firstOrFail();
        $this->assertSame(User::ROLE_ADMIN, $admin->role);
        $this->assertTrue(Hash::check('password', $admin->password));

        $this->assertDatabaseHas('users', [
            'email' => 'staff@example.com',
            'role' => User::ROLE_STAFF,
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'viewer@example.com',
            'role' => User::ROLE_VIEWER,
        ]);
    }
}
