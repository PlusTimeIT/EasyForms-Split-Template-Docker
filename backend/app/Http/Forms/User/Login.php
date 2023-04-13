<?php
namespace App\Http\Forms\User;

use App\Models\User;
use Illuminate\Http\Request;
use PlusTimeIT\EasyForms\Base\InputForm;
use PlusTimeIT\EasyForms\Elements\{Action, Alert, Axios, Button, Header, Icon, ProcessResponse, RuleItem};
use PlusTimeIT\EasyForms\Fields\{PasswordField, TextField};
use PlusTimeIT\EasyForms\Traits\Transformable;

class Login extends InputForm
{
    use Transformable;

    public function __construct()
    {
        parent::__construct();
        return $this
            ->setName('User\Login')
            ->setTitle('Login');
    }

    public function alerts(): array
    {
        return [
            Alert::make()
                ->setTrigger('successful_processing')
                ->setType('success')
                ->setColor('green')
                ->setProminent(TRUE)
                ->setBorder('top')
                ->setDismissible(TRUE)
                ->setAutoCloseTimer(2000)
                ->setContents('Access Granted - Please wait...')
            ,
            Alert::make()
                ->setTrigger('failed_processing')
                ->setType('error')
                ->setColor('error')
                ->setProminent(TRUE)
                ->setBorder('top')
                ->setDismissible(TRUE)
                ->setAutoCloseTimer(2000)
                ->setContents('<response-data>'),
        ];
    }

    public function axios(): Axios
    {
        return Axios::make()
            ->setExpectingResults(TRUE);
    }

    public function buttons(): array
    {
        return [
            Button::make()
                ->setType('process')
                ->setColor('primary')
                ->setText('Login')
                ->setIcon(
                    Icon::make()->setIcon('mdi-account-badge-outline')->setTooltip('Login')
                )
                ->setOrder(0)
            ,
        ];
    }

    public function fields(): array
    {
        return [
            TextField::make()
                ->setName('username')
                ->setOrder(0)
                ->setLabel('Username')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('exists')->setValue('users,username'),
                ]),
            PasswordField::make()
                ->setName('password')
                ->setOrder(1)
                ->setLabel('Password')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ]),
        ];
    }

    public static function process(Request $request)
    {
        //validation successful check login
        $user = User::where('username', $request->username);

        if ( ! $user->exists()) {
            return ProcessResponse::make()->failed()->data('Invalid User');
        }
        $user = $user->first();
        if ( ! $user->login($request)) {
            return ProcessResponse::make()->failed()->data('Invalid credentials');
        }

        return ProcessResponse::make()->success()->data(\Auth::user())->redirect('Dashboard');
    }
}
