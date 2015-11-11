<?php
namespace HipChat\Manifest\Capability;

use HipChat\Manifest\AbstractNode;

/**
 * Object handling HipChatApiConsumer capabilities
 *
 */
class ApiConsumerCapability extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->addNested('avatar',$this->getIconValidator());

        $validator->add('fromName', [
            'required' => ['rule' => 'notBlank'],
        ]);

        $validator->requirePresence('scopes');
        $validator->add('scopes', [
            'valid' => [
                'rule' => [
                    'multiple',
                    [
                        'admin_group',
                        'admin_room',
                        'import_data',
                        'manage_rooms',
                        'send_message',
                        'send_notification',
                        'view_group',
                        'view_messages',
                        'view_room',
                    ]
                ]
            ]
        ]);

        return $validator;
    }

}

