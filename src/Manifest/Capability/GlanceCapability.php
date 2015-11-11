<?php
namespace HipChat\Manifest\Capability;

use HipChat\Manifest\AbstractNode;

/**
 * Object handling Glance capabilities
 *
 * @see https://www.hipchat.com/docs/apiv2/glance
 */
class GlanceCapability extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->addNested('icon', $this->getIconValidator());

        $validator->requirePresence('key');
        $validator->add('key', ['required' => ['rule' => 'notBlank']]);

        $validator->addNested('name', $this->getI18nValidator());

        $validator->requirePresence('queryUrl');
        $validator->add('queryUrl', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url'],
        ]);

        $validator->add('target', []);

        $validator->add('weight', [
            'valid' => ['rule' => 'isInteger']
        ]);

        return $validator;
    }

}
