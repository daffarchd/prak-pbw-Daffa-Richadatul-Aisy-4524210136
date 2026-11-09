<?php

namespace Tests\Feature;

use App\Filament\Widgets\LibraryStatsWidget;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_displays_library_statistics(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        Author::factory()->count(2)->create();
        Book::factory()->create(['status' => 'available']);
        Book::factory()->create(['status' => 'borrowed']);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertOk()
            ->assertSee('Dashboard');

        Livewire::test(LibraryStatsWidget::class)
            ->assertSee('Total Books')
            ->assertSee('Total Authors')
            ->assertSee('Available Books')
            ->assertSee('Borrowed Books');
    }

    public function test_staff_can_open_book_creation_page(): void
    {
        $staff = User::factory()->create(['role' => User::ROLE_STAFF]);

        $this->actingAs($staff)
            ->get('/admin/books/create')
            ->assertOk()
            ->assertSee('Description')
            ->assertSee('Categories');
    }

    public function test_viewer_can_list_books_but_cannot_open_creation_page(): void
    {
        $viewer = User::factory()->create(['role' => User::ROLE_VIEWER]);

        $this->actingAs($viewer)
            ->get('/admin/books')
            ->assertOk();

        $this->actingAs($viewer)
            ->get('/admin/books/create')
            ->assertForbidden();
    }
}
