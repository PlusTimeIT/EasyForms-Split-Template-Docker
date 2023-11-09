<?php

namespace App\Http\Forms\Input;

use Illuminate\Http\Request;
use PlusTimeIT\EasyForms\Base\InputForm;
use PlusTimeIT\EasyForms\Elements\Alert;
use PlusTimeIT\EasyForms\Elements\Button;
use PlusTimeIT\EasyForms\Elements\FormLoader;
use PlusTimeIT\EasyForms\Elements\Icon;
use PlusTimeIT\EasyForms\Elements\LoadResponse;
use PlusTimeIT\EasyForms\Elements\ProcessResponse;
use PlusTimeIT\EasyForms\Elements\ProgressLinear;
use PlusTimeIT\EasyForms\Elements\RuleItem;
use PlusTimeIT\EasyForms\Elements\Tooltip;
use PlusTimeIT\EasyForms\Enums\AlertTriggers;
use PlusTimeIT\EasyForms\Enums\AlertTypes;
use PlusTimeIT\EasyForms\Enums\FormLoaderTypes;
use PlusTimeIT\EasyForms\Fields\PasswordField;
use PlusTimeIT\EasyForms\Fields\TextField;
use PlusTimeIT\EasyForms\Traits\Transformable;

final class LinearServer extends InputForm
{
    use Transformable;

    public function __construct()
    {
        parent::__construct();

        return $this
            ->setName('LinearServer')
            ->setLoader(
                FormLoader::make()
                ->setType(FormLoaderTypes::Linear)
                ->setProgress(
                    ProgressLinear::make()
                    ->setActive(true)
                    ->setIndeterminate(true)
                )
            )
            ->setTitle('Load from page with linear loader');
    }

    public function alerts(): array
    {
        return [
            Alert::make([
                'type' => AlertTypes::Warning,
                'trigger' => AlertTriggers::AfterLoad,
                'closable' => true,
                'prominent' => true,
                'text' => 'After Load - This alerts displays after loading.',
            ]),
            Alert::make()
                ->setType(AlertTypes::Info)
                ->setTrigger(AlertTriggers::BeforeProcessing)
                ->setColor('secondary')
                ->setBorder('top')
                ->setClosable(false)
                ->setTextStyle(true)
                ->setProminent(true)
                ->setText('Before Processing - This alert shows before the processing request. <p>This is a sticky alert</p> <p><a target="_blank" href="/example/2">Check out Example 2 😁</a></p>')
                ->setIcon(
                    Icon::make()->setSize('large')->setIcon('mdi-note-multiple')
                ),
            Alert::make()
                ->setType(AlertTypes::Warning)
                ->setTrigger(AlertTriggers::FailedValidation)
                ->setColor('blue')
                ->setBorder('end')
                ->setClosable(false)
                ->setProminent(true)
                ->setAutoCloseTimer(2500)
                ->setProminent(true)
                ->setText('Failed Validation - This alert shows when validation errors are present (will disappear in 2.5 seconds).')
                ->setIcon(
                    Icon::make()->setSize('small')->setIcon('mdi-rocket')
                ),
            Alert::make()
                ->setType(AlertTypes::Success)
                ->setTrigger(AlertTriggers::AfterProcessing)
                ->setBorder('top')
                ->setClosable(true)
                ->setText('After Processing - This alert shows after processing [Not Prominent] - regardless of result'),
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
                ->setProminent(true)
                ->setBorder('top')
                ->setClosable(true)
                ->setText('Successful Processing - This alert shows on successful processing [Prominent] - Response: <response-data>'),
            Alert::make()
                ->setType(AlertTypes::Info)
                ->setTrigger(AlertTriggers::Cancelled)
                ->setColor('pink')
                ->setBorder('end')
                ->setClosable(true)
                ->setProminent(true)
                ->setText('Cancelled - This alert shows when a form has been cancelled.'),
            Alert::make()
                ->setType(AlertTypes::Info)
                ->setTrigger(AlertTriggers::FormReset)
                ->setColor('grey')
                ->setBorder('top')
                ->setClosable(true)
                ->setProminent(true)
                ->setText('Form Reset - This alertshows when a form has been reset.'),
        ];
    }

    public function buttons(): array
    {
        return [
            Button::make()
                ->setType('process')
                ->setColor('primary')
                ->setText('Login')
                ->setPrependIcon(
                    Icon::make()
                        ->setIcon('mdi-login')
                        ->setColor('secondary')
                        ->setTooltip(
                            Tooltip::make()->setText('Process Form')
                        )
                )
                ->setOrder(0),
            Button::make()
                ->setType('cancel')
                ->setColor('red')
                ->setText('Cancel Form')
                ->setOrder(1)
                ->setPrependIcon(
                    Icon::make()
                        ->setIcon('mdi-cancel')
                        ->setColor('accent')
                        ->setTooltip(
                            Tooltip::make()->setText('Click here to cancel the form')
                        )
                ),
            Button::make()
                ->setType('reset')
                ->setColor('secondary')
                ->setText('Reset Form')
                ->setOrder(2)
                ->setPrependIcon(
                    Icon::make()
                        ->setIcon('mdi-refresh')
                        ->setColor('pink')
                        ->setTooltip(
                            Tooltip::make()->setText('Click here to reset the form')
                        )
                ),

        ];
    }

    public function fields(): array
    {
        return [
            TextField::make()
                ->setName('username')
                ->setOrder(0)
                ->setClearable(true)
                ->setHelp('OH OH')
                ->setLabel('Username')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(true),
                ]),
            PasswordField::make()
                ->setName('password')
                ->setOrder(1)
                ->setLabel('Password')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(true),
                ]),
        ];
    }

    
    public static function load(request $request): LoadResponse
    {
        // we can just set this to preFill if we want to load by axios later
        return LoadResponse::make()->success()->form(self::make()->fill());
    }
    
    public function fill(): self
    {
        //this form is always loaded by page not axios so we want to prefill it
        $fakeData = [
            'username' => 'Pre-populated Username',
        ];

        return $this->populateFields($fakeData);
    }

    public static function process(request $request): ProcessResponse
    {
        //request has been validated so we know what we have.
        $username = $request->username;

        //run checks
        if ($username !== 'Pre-populated Username') {
            return ProcessResponse::make()->failed()->data('Wrong username silly, use the preloaded one');
        }

        return ProcessResponse::make()->success()->data('Yay you logged in!');
    }
}
