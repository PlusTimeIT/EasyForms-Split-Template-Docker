<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Handles all callbacks for authenticated routes.
 */

class UserController extends Controller
{
    use \App\Traits\hasRequestGuard;

    public function __construct()
    {

    }



}
