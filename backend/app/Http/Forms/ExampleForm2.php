<?php
namespace App\Http\Forms;

use Illuminate\Http\Request;
use PlusTimeIT\EasyForms\Base\InputForm;
use PlusTimeIT\EasyForms\Elements\{
    Action,
    Alert,
    Axios,
    Button,
    Header,
    Icon,
    RadioItem,
    RuleItem,
    SelectItem
};
use PlusTimeIT\EasyForms\Fields\{
    AutoCompleteField,
    CheckboxField,
    ColorPickerField,
    DatePickerField,
    FileInputField,
    HiddenField,
    NumberField,
    PasswordField,
    RadioGroupField,
    SelectField,
    TextField,
    TextareaField,
    TimePickerField
};
use PlusTimeIT\EasyForms\Traits\Transformable;

final class ExampleForm2 extends InputForm
{
    use Transformable;

    public function __construct()
    {
        parent::__construct();
        return $this
            ->setName('ExampleForm2')
            ->setTitle('Load from axios with conditionals');
    }

    public function alerts(): array
    {
        return [
            Alert::make()
                ->setTrigger('process_failed')
                ->setColor('red')
                ->setBorder('top')
                ->setDismissible(TRUE)
                ->setTextStyle(TRUE)
                ->setContents('Form Failed!')
                ->setIcon(
                    Icon::make()->setIcon('mdi-file-excel-box')
                ),
        ];
    }

    public function buttons(): array
    {
        return [
            Button::make()
                ->setType('process')
                ->setColor('primary')
                ->setText('Register')
                ->setIcon(
                    Icon::make()->setIcon('mdi-star')->setTooltip('Register online!')
                )
                ->setOrder(0)
            ,
            Button::make()
                ->setType('reset')
                ->setColor('secondary')
                ->setText('Reset Form')
                ->setIcon(
                    Icon::make()->setIcon('mdi-refresh')->setTooltip('Reset the form fields')
                )
                ->setOrder(1),
        ];
    }

    public function fields(): array
    {
        return [
            TextField::make()
                ->setName('username')
                ->setOrder(0)
                ->setLabel('Username')
                ->setMaxLength(20)
                ->setCounter(TRUE)
                ->setHelp('This is your Username!')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('max')->setValue(20),
                ])
            ,
            PasswordField::make()
                ->setName('password')
                ->setOrder(1)
                ->setLabel('Password')
                ->setMaxLength(35)
                ->setCounter(TRUE)
                ->setHelp('This is your Password!')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('min')->setValue(10),
                    RuleItem::make()->setName('max')->setValue(35),
                ])
            ,
            TextField::make()
                ->setName('email')
                ->setOrder(2)
                ->setLabel('Email')
                ->setHelp('Leave your email!')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('email')->setValue('filter'),
                ])
            ,
            ColorPickerField::make()
                ->setName('customer_colour')
                ->setMode('hexa')
                ->setOrder(2)
                ->setLabel('Customer Colour')
                ->setHelp('Select a colour for this customer')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            FileInputField::make()
                ->setName('resume')
                ->setOrder(3)
                ->setLabel('Upload your resume in .doc or .pdf')
                ->setHelp('Upload your resume!')
                ->setAccept('.doc,.pdf')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('mimes')->setValue('application/msword,application/pdf'),
                ])
            ,
            FileInputField::make()
                ->setName('avatar')
                ->setOrder(3)
                ->setLabel('Upload your avatar image')
                ->setHelp('Upload your avatar!')
                ->setAccept('image/*')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('mimes')->setValue('image/jpeg,image/png'),
                ])
            ,
            TextField::make()
                ->setName('experience')
                ->setOrder(4)
                ->setLabel('Years Experience')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                    RuleItem::make()->setName('integer')->setValue(TRUE),
                ])
            ,
            TextareaField::make()
                ->setName('notes')
                ->setOrder(5)
                ->setLabel('Account Notes')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            CheckboxField::make()
                ->setName('terms')
                ->setOrder(6)
                ->setLabel('Do you accept the current terms and conditions')
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            SelectField::make()
                ->setName('favourite_fruit')
                ->setOrder(8)
                ->setLabel('What\'s your favourite fruit?')
                ->setItemText('value')
                ->setItemValue('id')
                ->setItems([
                    SelectItem::make()->setId(0)->setValue('Chicken'),
                    SelectItem::make()->setId(1)->setValue('Banana'),
                    SelectItem::make()->setId(2)->setValue('Watermelon'),
                    SelectItem::make()->setId(3)->setValue('Grapes'),
                ])
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            SelectField::make()
                ->setName('customer_select')
                ->setOrder(8)
                ->setLabel('Select Customers')
                ->setItemText('value')
                ->setItemValue('id')
                ->setItems([
                    SelectItem::make()->setId(0)->setValue('John Doe'),
                    SelectItem::make()->setId(1)->setValue('Sammy Did'),
                    SelectItem::make()->setId(2)->setValue('Smithy McSmithy'),
                    SelectItem::make()->setId(3)->setValue('HELLO WORLD INC.'),
                    SelectItem::make()->setId(4)->setValue('Earth Movers From Earth'),
                ])
                ->setRules([
                    RuleItem::make(['name' => 'required', 'value' => TRUE]),
                ])
            ,
            SelectField::make()
                ->setName('officer_select')
                ->setOrder(8)
                ->setLabel('Select an Officer')
                ->setItemText('value')
                ->setItemValue('badge_id')
                ->loadItems(function($customer_id) {
                    if ( ! $customer_id && $customer_id !== 0) {
                        // this wasn't passed or it was null
                        return NULL;
                    }
                    $officers = self::getOfficers();
                    // dependsOn should be an ID from the customers above
                    if ( ! isset($officers[$customer_id])) {
                        return NULL;
                    }
                    return collect($officers[$customer_id])
                        ->map(fn($officer) => SelectItem::make()->setId($officer['id'])->setValue($officer['name']))
                        ->toArray();
                })
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
                ->dependsOn('customer_select')
            ,
            AutoCompleteField::make()
                ->setName('rating')
                ->setOrder(10)
                ->setLabel('Leave us a rating')
                ->setItemText('value')
                ->setItemValue('id')
                ->setItems([
                    SelectItem::make()->setId(1)->setValue('1 Star'),
                    SelectItem::make()->setId(2)->setValue('2 Star'),
                    SelectItem::make()->setId(3)->setValue('3 Star'),
                    SelectItem::make()->setId(4)->setValue('4 Star'),
                    SelectItem::make()->setId(5)->setValue('5 Star'),
                ])
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            RadioGroupField::make()
                ->setName('sky_colour')
                ->setOrder(11)
                ->setLabel('What\'s the colour of the sky?')
                ->setItems([
                    RadioItem::make()
                        ->setLabel('The sky is blue')
                        ->setValue('blue')
                        ->setColor('blue')
                    ,
                    RadioItem::make()
                        ->setLabel('The sky is red')
                        ->setValue('red')
                        ->setColor('red')
                    ,
                    RadioItem::make()
                        ->setLabel('The sky is pink')
                        ->setValue('pink')
                        ->setColor('pink')
                    ,
                ])
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            DatePickerField::make()
                ->setName('birth_date')
                ->setLabel('Whats ya Birthday?')
                ->setValue(\Carbon\Carbon::now()->toIso8601String())
                ->setOrder(12)
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
            TimePickerField::make()
                ->setName('born_time')
                ->setLabel('What time were you born?')
                ->setValue([])
                ->setOrder(13)
                ->setRules([
                    RuleItem::make()->setName('required')->setValue(TRUE),
                ])
            ,
        ];
    }

    public static function getOfficers()
    {
        return [
            0 => [
                ['id' => 0, 'name' => 'Steve'],
                ['id' => 1, 'name' => 'John'],
                ['id' => 2, 'name' => 'Sally'],
            ],
            1 => [
                ['id' => 3, 'name' => 'Bob'],
                ['id' => 4, 'name' => 'Billy'],
                ['id' => 5, 'name' => 'Sam'],
            ],
            2 => [
                ['id' => 6, 'name' => 'Jane'],
                ['id' => 7, 'name' => 'Lilly'],
                ['id' => 8, 'name' => 'Ben'],
            ],
            3 => [
                ['id' => 9, 'name' => 'Steve'],
                ['id' => 10, 'name' => 'Simon'],
                ['id' => 11, 'name' => 'Alex'],
            ],
            4 => [
                ['id' => 12, 'name' => 'Wendy'],
                ['id' => 13, 'name' => 'Jim'],
                ['id' => 14, 'name' => 'Mark'],
            ],
        ];
    }

    public static function process(request $request)
    {
        $form = self::make();
    }
}
