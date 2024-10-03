<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pages.
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the page.
     */
    public function view(User $user, Page $page)
    {
        return $user->isAdmin() || $page->isPublished();
    }

    /**
     * Determine whether the user can create pages.
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the page.
     */
    public function update(User $user, Page $page)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the page.
     */
    public function delete(User $user, Page $page)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the page.
     */
    public function restore(User $user, Page $page)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the page.
     */
    public function forceDelete(User $user, Page $page)
    {
        return $user->isAdmin();
    }
}
