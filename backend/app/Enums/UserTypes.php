<?php
namespace App\Enums;

/**
 * List all possible User types
 */
enum UserTypes : string
{
    /** @static Create an admin account under the admin guard */
    CASE admin = 'admin';
    /** @static Create a user account under the user guard */
    CASE user = 'user';
}
