<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\UserHierarchy;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserHierarchyListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatedEvent $event): void
    {
        $createdUser = $event->user;

        $user = $createdUser;

        UserHierarchy::create([
            "user_id" => $createdUser->id,
            "parent_id" => $createdUser->id,
            "type" => $createdUser->type,
            "rank_point" => $createdUser->type->rankPoint()
        ]);

        while ($user->parent) {
            $parent = $user->parent;

            UserHierarchy::create([
                "user_id" => $createdUser->id,
                "parent_id" => $parent->id,
                "type" => $parent->type,
                "rank_point" => $parent->type->rankPoint()
            ]);

            $user = $parent;
        }
    }
}
