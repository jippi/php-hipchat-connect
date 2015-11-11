<?php
namespace HipChat\Manifest;

/**
 * Links scope for HipChat manifests
 *
 * Handles the "links" section of the root manifest document
 */
class Links extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $validator->requirePresence('homepage');
        $validator->add('homepage', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url'],
        ]);

        $validator->requirePresence('self');
        $validator->add('self', [
            'required' => ['rule' => 'notBlank'],
            'url' => ['rule' => 'url']
        ]);

        return $validator;
    }

}
