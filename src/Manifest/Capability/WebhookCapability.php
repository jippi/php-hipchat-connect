<?php
namespace HipChat\Manifest\Capability;

use HipChat\Manifest\AbstractNode;

/**
 * Object handling Webhook capabilities
 *
 * @see https://www.hipchat.com/docs/apiv2/webhooks
 */
class WebhookCapability extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->requirePresence('url');
        $validator->add('url', [
            'required' => [
                'rule' => 'notBlank'
            ],
            'url' => [
                'rule' => 'url'
            ],
        ]);

        $validator->add('pattern', [

        ]);

        $validator->requirePresence('event');
        $validator->add('event', [
            'required' => [
                'rule' => 'notBlank'
            ],
            'valid' => [
                'rule' => [
                    'inList',
                    [
                        'room_archived',
                        'room_created',
                        'room_deleted',
                        'room_enter',
                        'room_exit',
                        'room_file_upload',
                        'room_message',
                        'room_notification',
                        'room_topic_change',
                        'room_unarchived'
                    ]
                ]
            ]
        ]);

        $validator->add('authentication', [
            'valid' => [
                'rule' => [
                    'inList',
                    [
                        'jwt',
                        'none'
                    ]
                ]
            ]
        ]);

        $validator->add('name', [

        ]);

        return $validator;
    }

}
