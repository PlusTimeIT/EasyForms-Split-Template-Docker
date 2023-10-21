<?php
namespace App\Http\Forms;

use Illuminate\Http\Request;
use PlusTimeIT\EasyForms\Base\ActionForm;
use PlusTimeIT\EasyForms\Controllers\Users;
use PlusTimeIT\EasyForms\Elements\ProcessResponse;
use PlusTimeIT\EasyForms\Elements\{Action, ActionIcon, Alert, Axios, Button, ConditionItem, Header, Icon, RadioItem, RuleItem, SelectItem};
use PlusTimeIT\EasyForms\Fields\{AutoCompleteField, CheckboxField, FileInputField, HiddenField, NumberField, PasswordField, RadioGroupField, SelectField, TextField, TextareaField};
use PlusTimeIT\EasyForms\Traits\Transformable;

final class ExampleForm4 extends ActionForm
{
    use Transformable;

    public function __construct()
    {
        parent::__construct();
        return $this
            ->setName('ExampleForm4')
            ->setTitle('Action Form with conditional icons')
            ->setInline(TRUE);
    }

    public function actions(): array
    {
        return [
            ActionIcon::make()
                ->setIdentifier('editUser')
                ->setName('Edit User Details')
                ->setCols(NULL)
                ->setIcon(
                    Icon::make()->setIcon('mdi-pencil')->setTooltip('Edit Action')
                )
                ->setCallback('editUser')
                ->setOrder(0)
            ,
            ActionIcon::make()
                ->setIdentifier('activateUser')
                ->setName('Activate User')
                ->setCols(NULL)
                ->setIcon(
                    Icon::make(['icon' => 'mdi-account-check', 'tooltip' => 'Activate User'])
                )
                ->setConditions([
                    ConditionItem::make('status', '!=', 'active'),
                ])
                ->setCallback('deleteUser')
                ->setOrder(1),
            ActionIcon::make()
                ->setIdentifier('deactivateUser')
                ->setName('Deactivate User')
                ->setCols(NULL)
                ->setIcon(
                    Icon::make(['icon' => 'mdi-account-clock', 'tooltip' => 'Deactivate User'])
                )
                ->setConditions([
                    ConditionItem::make('status', '!=', 'inactive'),
                ])
                ->setCallback('deleteUser')
                ->setOrder(2),
            ActionIcon::make()
                ->setIdentifier('banUser')
                ->setCols(NULL)
                ->setName('Ban User')
                ->setConditions([
                    ConditionItem::make('status', '!=', 'banned'),
                ])
                ->setIcon(
                    Icon::make(['icon' => 'mdi-account-off', 'tooltip' => 'Ban User'])
                )
                ->setCallback('banUser')
                ->setOrder(3),
            ActionIcon::make()
                ->setIdentifier('deleteUser')
                ->setCols(NULL)
                ->setName('Delete User')
                ->setIcon(
                    Icon::make(['icon' => 'mdi-delete-circle', 'tooltip' => 'Delete Action'])
                )
                ->setCallback('deleteUser')
                ->setOrder(4),
        ];
    }

    public static function activateUser(request $request)
    {
        Users::updateUserStatus($request->id, 'active');
        return ProcessResponse::make()
            ->success()
            ->data('You just activated them')
            ->redirect('reload');
    }

    public function alerts(): array
    {
        return [
            Alert::make()
                ->setTrigger('failed_processing')
                ->setType('error')
                ->setColor('red')
                ->setProminent(TRUE)
                ->setBorder('bottom')
                ->setDismissible(TRUE)
                ->setContents('Processing Failed!')
            ,
            Alert::make()
                ->setTrigger('successful_processing')
                ->setType('success')
                ->setColor('green')
                ->setProminent(TRUE)
                ->setBorder('top')
                ->setDismissible(TRUE)
                ->setContents('Processing Successful!'),
        ];
    }

    public static function banUser(request $request)
    {
        Users::updateUserStatus($request->id, 'banned');
        return ProcessResponse::make()
            ->success()
            ->data('You just banned them!')
            ->redirect('reload');
    }

    public static function deactivateUser(request $request)
    {
        Users::updateUserStatus($request->id, 'inactive');
        return ProcessResponse::make()
            ->success()
            ->data('You just made them inactive!')
            ->redirect('reload');
    }

    public static function deleteUser(request $request)
    {
        $user = Users::find($request->id);
        if ( ! $user) {
            return ProcessResponse::make()
                ->failed()
                ->data('User not found with id:' . $user->get('id'));
        }

        if (Users::deleteUser($request->id)) {
            return ProcessResponse::make()->success()->data('Successfully deleted user')->redirect('reload');
        }

        return ProcessResponse::make()->failed()->data('Unable to delete user');
    }

    public static function editUser(request $request)
    {
        //check if user exists if it does send redirect
        $user = Users::find($request->id);
        if ( ! $user) {
            return ProcessResponse::make()
                ->failed()
                ->data('User not found with id:' . $request->id);
        }
        return ProcessResponse::make()
            ->success()
            ->data('Found user id:' . $user->get('id'))
            ->redirect('/example-5/' . $user->get('id'));
    }

    public static function process(request $request)
    {
        if ( ! $request->form_action || ! collect(self::make()->actions())->where('identifier', $request->form_action)) {
            return ProcessResponse::make()->failed()->data('Don\'t mess with the actions yo!');
        }
        return self::{$request->form_action}($request);
    }
}
