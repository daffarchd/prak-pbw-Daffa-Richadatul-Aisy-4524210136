<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [User::ROLE_STAFF, User::ROLE_VIEWER], true);
    }

    public function view(User $user, Book $book): bool
    {
        return in_array($user->role, [User::ROLE_STAFF, User::ROLE_VIEWER], true);
    }

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_STAFF;
    }

    public function update(User $user, Book $book): bool
    {
        return $user->role === User::ROLE_STAFF;
    }

    public function delete(User $user, Book $book): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Book $book): bool
    {
        return false;
    }

    public function forceDelete(User $user, Book $book): bool
    {
        return false;
    }

    public function forceDeleteAny(User $user): bool
    {
        return false;
    }
}
