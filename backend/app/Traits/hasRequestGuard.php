<?php
namespace App\Traits;

trait hasRequestGuard
{
    protected $guard;

    /**
     * Return the current Authentication Guard Statically.
     *
     * @return string
     */
    public static function guardName()
    {
        return collect(array_keys(config('auth.guards')))
            ->first(
                fn($guard) => auth()
                    ->guard($guard)
                    ->check()
            );
    }

    /**
     * Return the current Authentication Guard.
     *
     * @return string
     */
    public function requestGuardName()
    {
        $guards = array_keys(config('auth.guards'));
        $this->guard = collect($guards)
            ->first(
                fn($guard) => auth()
                    ->guard($guard)
                    ->check()
            );
        return $this->guard;
    }
}
