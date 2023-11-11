<?php

namespace App\Http\Forms\Action;

use Illuminate\Http\Request;
use PlusTimeIT\EasyForms\Base\ActionForm;
use PlusTimeIT\EasyForms\Controllers\Users;
use PlusTimeIT\EasyForms\Elements\ActionIcon;
use PlusTimeIT\EasyForms\Elements\Alert;
use PlusTimeIT\EasyForms\Elements\ConditionItem;
use PlusTimeIT\EasyForms\Elements\Icon;
use PlusTimeIT\EasyForms\Elements\ProcessResponse;
use PlusTimeIT\EasyForms\Elements\Tooltip;
use PlusTimeIT\EasyForms\Enums\AlertTriggers;
use PlusTimeIT\EasyForms\Enums\AlertTypes;
use PlusTimeIT\EasyForms\Traits\Transformable;

final class IconsServer extends ActionForm
{
    use Transformable;

    public function __construct()
    {
        parent::__construct();

        return $this
            ->setName('Action\IconsServer')
            ->setTitle('Action Form with conditional icons')
            ->setInline(true);
    }

    public function actions(): array
    {
        return [
            ActionIcon::make()
                ->setIdentifier('editUser')
                ->setName('Edit User Details')
                ->setCols(null)
                ->setIcon(
                    Icon::make()->setIcon('mdi-pencil')->setTooltip(Tooltip::make()->setText('Edit User'))
                )
                ->setCallback('editUser')
                ->setOrder(0),
            ActionIcon::make()
                ->setIdentifier('activateUser')
                ->setName('Activate User')
                ->setCols(null)
                ->setConditions([
                    ConditionItem::make(['check' => 'status', 'operator' => '!=', 'against' => 'active']),
                ])
                ->setIcon(
                    Icon::make(['icon' => 'mdi-account-check'])->setTooltip(Tooltip::make()->setText('Activate User'))
                )
                ->setCallback('deleteUser')
                ->setOrder(1),
            ActionIcon::make()
                ->setIdentifier('deactivateUser')
                ->setName('Deactivate User')
                ->setCols(null)
                ->setConditions([
                    ConditionItem::make(['check' => 'status', 'operator' => '==', 'against' => 'active']),
                ])
                ->setIcon(
                    Icon::make(['icon' => 'mdi-account-clock'])->setTooltip(Tooltip::make()->setText('Deactivate User'))
                )
                ->setCallback('deleteUser')
                ->setOrder(2),
            ActionIcon::make()
                ->setIdentifier('banUser')
                ->setCols(null)
                ->setName('Ban User')
                ->setConditions([
                    ConditionItem::make(['check' => 'status', 'operator' => '!=', 'against' => 'banned']),
                ])
                ->setIcon(
                    Icon::make(['icon' => 'mdi-account-off'])->setTooltip(Tooltip::make()->setText('Ban User'))
                )
                ->setCallback('banUser')
                ->setOrder(3),
            ActionIcon::make()
                ->setIdentifier('deleteUser')
                ->setCols(null)
                ->setName('Delete User')
                ->setIcon(
                    Icon::make(['icon' => 'mdi-delete-circle'])->setTooltip(Tooltip::make()->setText('Delete User'))
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
                ->setType(AlertTypes::Error)
                ->setTrigger(AlertTriggers::FailedProcessing)
                ->setColor('red')
                ->setProminent(true)
                ->setBorder('bottom')
                ->setClosable(true)
                ->setText('Failed Processing - This alert shows if the processing fails - Response: <response-data>'),
            Alert::make()
                ->setType(AlertTypes::Success)
                ->setTrigger(AlertTriggers::SuccessProcessing)
                ->setColor('green')
                ->setProminent(true)
                ->setBorder('top')
                ->setClosable(true)
                ->setText('Successful Processing - This alert shows on successful processing - Response: <response-data>'),
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
        if (! $user) {
            return ProcessResponse::make()
                ->failed()
                ->data('User not found with id:'.$user->get('id'));
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
        if (! $user) {
            return ProcessResponse::make()
                ->failed()
                ->data('User not found with id:'.$request->id);
        }

        return ProcessResponse::make()
            ->success()
            ->data('Found user id:'.$user->get('id'))
            ->redirect('/example-5/'.$user->get('id'));
    }

    public static function process(request $request): ProcessResponse
    {
        if (! $request->form_action || ! collect(self::make()->actions())->where('identifier', $request->form_action)) {
            return ProcessResponse::make()->failed()->data('Don\'t mess with the actions yo!');
        }

        return self::{$request->form_action}($request);
    }
}
