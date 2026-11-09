<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class BookPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_perform_all_book_actions(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $book = Book::factory()->create();

        foreach (['viewAny', 'view', 'create', 'update', 'delete', 'deleteAny', 'forceDelete', 'forceDeleteAny'] as $ability) {
            $arguments = in_array($ability, ['view', 'update', 'delete', 'forceDelete'], true)
                ? [$book]
                : [Book::class];

            $this->assertTrue(Gate::forUser($admin)->allows($ability, $arguments));
        }
    }

    public function test_staff_can_create_update_and_view_books_but_cannot_delete(): void
    {
        $staff = User::factory()->create(['role' => User::ROLE_STAFF]);
        $book = Book::factory()->create();

        $this->assertTrue(Gate::forUser($staff)->allows('viewAny', Book::class));
        $this->assertTrue(Gate::forUser($staff)->allows('view', $book));
        $this->assertTrue(Gate::forUser($staff)->allows('create', Book::class));
        $this->assertTrue(Gate::forUser($staff)->allows('update', $book));
        $this->assertFalse(Gate::forUser($staff)->allows('delete', $book));
        $this->assertFalse(Gate::forUser($staff)->allows('deleteAny', Book::class));
    }

    public function test_viewer_can_only_view_books(): void
    {
        $viewer = User::factory()->create(['role' => User::ROLE_VIEWER]);
        $book = Book::factory()->create();

        $this->assertTrue(Gate::forUser($viewer)->allows('viewAny', Book::class));
        $this->assertTrue(Gate::forUser($viewer)->allows('view', $book));
        $this->assertFalse(Gate::forUser($viewer)->allows('create', Book::class));
        $this->assertFalse(Gate::forUser($viewer)->allows('update', $book));
        $this->assertFalse(Gate::forUser($viewer)->allows('delete', $book));
    }
}
