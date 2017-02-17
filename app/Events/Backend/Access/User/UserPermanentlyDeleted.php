<?php

namespace App\Events\Backend\Access\User;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserPermanentlyDeleted.
 */
class UserPermanentlyDeleted extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
