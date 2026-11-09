<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_and_categories_can_be_associated_many_to_many(): void
    {
        $book = Book::factory()->create();
        $category = Category::create(['name' => 'Fiction']);

        $book->categories()->attach($category);

        $this->assertTrue($book->fresh()->categories->contains($category));
        $this->assertTrue($category->fresh()->books->contains($book));
    }
}
