<?php
namespace Tests\Unit;

use App\Enums\{UserStatus, UserTypes};
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Session;
use Tests\TestCase;

/**
* Unit Tests for User Model.
* @see User
*/
class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @var \Illuminate\Session\SessionManager
    */
    protected $manager;

    public function setUp(): void
    {
        parent::setUp();

        $kernel = app('Illuminate\Contracts\Http\Kernel');
        $kernel->pushMiddleware('Illuminate\Session\Middleware\StartSession');

        // Avoid "Session store not set on request." - Exception!
        Session::setDefaultDriver('array');
        $this->manager = app('session');
    }

    /**
     * Test is a generic User can be created via a factory.
     * 0 added to function name to process first.
     * @return void
     */
    public function test_0_if_user_can_be_created()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    /**
     * Test if User can be of Admin Type.
     * @see UserTypes
     *
     * @return void
     */
    public function test_if_user_can_be_admin_type()
    {
        $user = User::factory()->create(['type' => UserTypes::admin->value]);
        $this->assertModelExists($user);

        $this->assertSame($user->guardName(), UserTypes::admin->value);
    }

    /**
     * Test if User can be of User Type.
     * @see UserTypes
     *
     * @return void
     */
    public function test_if_user_can_be_user_type()
    {
        $user = User::factory()->create(['type' => UserTypes::user->value]);
        $this->assertModelExists($user);

        $this->assertSame($user->guardName(), UserTypes::user->value);
    }

    /**
     * Test if User can return a successful login.
     * @see UserTypes
     *
     * @return void
     */
    public function test_if_user_can_return_successful_login()
    {
        $user = User::factory()->create(['username' => 'testingUser', 'password' => \password_hash('password', \PASSWORD_DEFAULT)]);
        $this->assertModelExists($user);

        $request = Request::create('/axios/login/form', 'POST', ['username' => 'testingUser', 'password' => 'password']);
        $request->setSession($this->manager->driver('array'));

        $login_result = $user->login($request);

        $this->assertTrue($login_result);
    }

    /**
     * Test if User returns correct guard for Type.
     * @see UserTypes
     *
     * @return void
     */
    public function test_if_user_returns_the_correct_guard()
    {
        $user = User::factory()->create(['type' => UserTypes::admin->value]);
        $this->assertModelExists($user);

        $this->assertSame($user->guardName(), UserTypes::admin->value);
    }

    /**
     * Test if a User can be Active.
     * @see UserStatus
     *
     * @return void
     */
    public function test_if_user_status_can_be_active()
    {
        $user = User::factory()->create(['status' => UserStatus::active]);
        $this->assertModelExists($user);

        $this->assertSame($user->status, UserStatus::active);
    }

    /**
     * Test if a User can be Archived.
     * @see UserStatus
     *
     * @return void
     */
    public function test_if_user_status_can_be_archived()
    {
        $user = User::factory()->create(['status' => UserStatus::archived]);
        $this->assertModelExists($user);

        $this->assertSame($user->status, UserStatus::archived);
    }

    /**
     * Test if a User can be Banned.
     * @see UserStatus
     *
     * @return void
     */
    public function test_if_user_status_can_be_banned()
    {
        $user = User::factory()->create(['status' => UserStatus::banned]);
        $this->assertModelExists($user);

        $this->assertSame($user->status, UserStatus::banned);
    }

    /**
     * Test if a User can be Inactive.
     * @see UserStatus
     *
     * @return void
     */
    public function test_if_user_status_can_be_inactive()
    {
        $user = User::factory()->create(['status' => UserStatus::inactive]);
        $this->assertModelExists($user);

        $this->assertSame($user->status, UserStatus::inactive);
    }

    /**
     * Test if a User can be Pending.
     * @see UserStatus
     *
     * @return void
     */
    public function test_if_user_status_can_be_pending()
    {
        $user = User::factory()->create(['status' => UserStatus::pending]);
        $this->assertModelExists($user);

        $this->assertSame($user->status, UserStatus::pending);
    }
}
