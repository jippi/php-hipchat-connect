<?php
namespace HipChat\Manifest;

/**
 * Vendor scope for HipChat manifests
 *
 * Handles the "vendor" section of the root manifest document
 */
class Vendor extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->requirePresence('name');
        $validator->add('name', [
            'required' => ['rule' => 'notBlank']
        ]);

        $validator->requirePresence('url');
        $validator->add('url', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url']
        ]);

        return $validator;
    }

}
