<?php

return [



    'current_password' => 'Heslo je nesprávne',
    'date' => 'Atribút :attribute nie je valídny dátum.',
    'email' => 'Atribút :attribute musí byť valídna e-mailová adresa.',
    'enum' => 'Zvolený atribút :attribute je nesprávny.',
    'exists' => 'Zvolený atribút :attribute je nesprávny.',
    'filled' => 'Atribút :attribute musí mať hodnotu.',
    'max' => [
        'numeric' => 'Atribút :attribute nesmie byť väčší ako :max.',
        'string' => 'Atribút :attribute nesmie byť dlhší ako :max znakov.',
    ],
    'min' => [
        'numeric' => 'Atribút :attribute nesmie byť menší ako :min.',
        'string' => 'Atribút :attribute nesmie byť kratší ako :min znakov.',
    ],
    'not_in' => 'Zvolený atribút :attribute je nesprávny.',
    'numeric' => 'Atribút :attribute musí byť číslo.',
    'present' => 'Atribút :attribute musí byť prítomný.',
    'required' => 'Atribút :attribute je povinný.',
    'string' => 'Atribút :attribute musí byť reťazec.',
    'unique' => 'Táto hodnota atribútu :attribute už existuje.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => ['name' => 'Meno', 'email' => 'E-mail', 'password' => 'Heslo',
                        'datum' => 'Dátum', 'pocet' => 'Počet'],

];
