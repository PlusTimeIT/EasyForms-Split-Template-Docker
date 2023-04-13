<?php
namespace App\Enums;

/**
 * List all possible User statuses.
 */
enum UserStatus: string
{
    /** @static string Applied to an active User */
    case active = 'active';
    /** @static string Applied to a User who is archived */
    case archived = 'archived';
    /** @static string Applied to a User who is banned */
    case banned = 'banned';
    /** @static string Applied to a User who is inactive */
    case inactive = 'inactive';
    /** @static Applied to a new User or a User who is pending email verification */
    case pending = 'pending';
}
