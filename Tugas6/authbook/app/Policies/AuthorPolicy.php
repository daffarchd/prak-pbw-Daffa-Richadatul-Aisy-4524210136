<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;

class AuthorPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, [User::ROLE_STAFF, User::ROLE_VIEWER], true);
    }

    public function view(User $user, Author $author): bool
    {
        return in_array($user->role, [User::ROLE_STAFF, User::ROLE_VIEWER], true);
    }

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_STAFF;
    }

    public function update(User $user, Author $author): bool
    {
        return $user->role === User::ROLE_STAFF;
    }

    public function delete(User $user, Author $author): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Author $author): bool
    {
        return false;
    }

    public function forceDelete(User $user, Author $author): bool
    {
        return false;
    }

    public function forceDeleteAny(User $user): bool
    {
        return false;
    }
}
