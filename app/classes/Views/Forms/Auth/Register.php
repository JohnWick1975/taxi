<?php

namespace App\Views\Forms\Auth;

use Core\Views\Form;

class Register extends Form
{
    public function __construct($data = [])
    {
        $data = [
            'attr' => [
                'method' => 'POST',
                'class' => 'register'
            ],
            'title' => 'Register',
            'fields' => [
                'name' => [
                    'type' => 'text',
                    'label' => 'Name:',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_string',
                        'validate_field_length' => [
                            'min' => 2,
                            'max' => 40
                        ]
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Exp. John',
                        ]
                    ]
                ],
                'secondname' => [
                    'type' => 'text',
                    'label' => 'Secondname:',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_string',
                        'validate_field_length' => [
                            'min' => 2,
                            'max' => 40
                        ]
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Exp. Rambo',
                        ]
                    ]
                ],
                'email' => [
                    'type' => 'text',
                    'label' => 'Email:',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_email'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'user@email.com',
                        ]
                    ]
                ],
                'password' => [
                    'type' => 'password',
                    'label' => 'Password:',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Password'
                        ]
                    ],
                ],
                'telephone' => [
                    'type' => 'text',
                    'label' => 'Name:',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Exp. +370......',
                        ]
                    ]
                ],
                'adress' => [
                    'type' => 'text',
                    'label' => 'Adress:',
                    'validators' => [
                        'validate_field_not_empty'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Exp. Vilnius, Papilenu g.',
                        ]
                    ]
                ],
            ],
            'validators' => [
                'validate_field_unique' => [
                    'field' => 'email'
                ]
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Register'
                ]
            ],
            'callbacks' => [
                'success' => 'form_success',
                'fail' => 'form_fail'
            ]
        ];

        parent::__construct($data);
    }
}