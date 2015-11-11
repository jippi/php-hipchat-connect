<?php
namespace HipChat\Manifest\Capability;

use HipChat\Manifest\AbstractNode;

/**
 * Object handling Action capabilities
 *
 * @see https://www.hipchat.com/docs/apiv2/actions
 */
class Action extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->requirePresence('key');
        $validator->add('key', [
            'required' => [
                'rule' => 'notBlank'
            ],
        ]);

        $validator->requirePresence('location');
        $validator->add('location', [
            'required' => [
                'rule' => 'notBlank'
            ],
            'valid' => [
                'rule' => [
                    'inList',
                    [
                        'hipchat.message.action',
                        'hipchat.input.action'
                    ]
                ]
            ]
        ]);

        $nameValidator = $this->newValidator();
        $nameValidator->requirePresence('value');
        $validator->addNested('name', $nameValidator);

        $validator->add('target', []);
        $validator->add('weight', [
            'valid' => ['rule' => 'isInteger']
        ]);

        return $validator;
    }

}
