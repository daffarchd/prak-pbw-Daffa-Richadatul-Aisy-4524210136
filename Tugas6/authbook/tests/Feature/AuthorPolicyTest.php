<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class AuthorPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_manage_authors_without_delete_access(): void
    {
        $staff = User::factory()->create(['role' => User::ROLE_STAFF]);
        $author = Author::factory()->create();

        $this->assertTrue(Gate::forUser($staff)->allows('viewAny', Author::class));
        $this->assertTrue(Gate::forUser($staff)->allows('view', $author));
        $this->assertTrue(Gate::forUser($staff)->allows('create', Author::class));
        $this->assertTrue(Gate::forUser($staff)->allows('update', $author));
        $this->assertFalse(Gate::forUser($staff)->allows('delete', $author));
        $this->assertFalse(Gate::forUser($staff)->allows('deleteAny', Author::class));
    }

    public function test_viewer_cannot_change_authors(): void
    {
        $viewer = User::factory()->create(['role' => User::ROLE_VIEWER]);
        $author = Author::factory()->create();

        $this->assertTrue(Gate::forUser($viewer)->allows('viewAny', Author::class));
        $this->assertTrue(Gate::forUser($viewer)->allows('view', $author));
        $this->assertFalse(Gate::forUser($viewer)->allows('create', Author::class));
        $this->assertFalse(Gate::forUser($viewer)->allows('update', $author));
        $this->assertFalse(Gate::forUser($viewer)->allows('delete', $author));
    }
}
