<?php
namespace HipChat\Manifest\Capability;

use HipChat\Manifest\AbstractNode;

/**
 * Object handling Installable capabilities
 *
 */
class InstallableCapability extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->add('allowGlobal', ['valid' => ['rule' => 'boolean']]);
        $validator->add('allowRoom', ['valid' => ['rule' => 'boolean']]);

        $validator->add('callbackUrl', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url'],
        ]);

        $validator->add('installedUrl', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url'],
        ]);

        $validator->add('uninstalledUrl', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url'],
        ]);

        return $validator;
    }

}
