<?php


namespace App\Views\Forms;


use Core\Views\Form;

class AddForm extends Form
{
    public function __construct($data = [])
    {
        $data = [
            'attr' => [
                'method' => 'POST',
                'class' => 'add_comment'
            ],
            'fields' => [
                'comment' => [
                    'label' => 'Add a comment',
                    'type' => 'textarea',
                    'validators' => [
                        'validate_field_not_empty'
                    ]
                ],
            ],
            'buttons' => [
                'save' => [
                    'title' => 'Add',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn',
                        ]
                    ]
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