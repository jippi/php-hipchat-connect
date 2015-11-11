<?php
namespace HipChat\Manifest\Capability;

use HipChat\Manifest\AbstractNode;

/**
 * Object handling Dialog capabilities
 *
 * @see https://www.hipchat.com/docs/apiv2/dialogs
 */
class DialogCapability extends AbstractNode {

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        $validator = parent::validator();

        $actionValidator = $this->newValidator();
        $actionValidator->addNested('name', $this->getI18nValidator());

        $validator->requirePresence('key');
        $validator->add('key', ['required' => ['rule' => 'notBlank']]);

        $validator->addNested('title', $this->getI18nValidator());

        $filterValidator = $this->newValidator();
        $filterValidator->addNested('placeholder', $this->getI18nValidator());

        $sizeValidator = $this->newValidator();
        $sizeValidator->requirePresence('height');
        $sizeValidator->requirePresence('width');

        $optionsValidator = $this->newValidator();
        $optionsValidator->addNested('filter', $filterValidator);
        $optionsValidator->addNested('hint', $this->getI18nValidator());
        $optionsValidator->addNested('primaryAction', $actionValidator);
        $optionsValidator->addNested('size', $sizeValidator);
        $optionsValidator->addNestedMany('secondaryActions', $actionValidator);
        $optionsValidator->add('style', [
            'required' => ['rule' => 'notBlank'],
            'valid' => ['rule' => ['inList', ['normal', 'warning']]]
        ]);

        $validator->addNested('options', $optionsValidator);

        $validator->requirePresence('url');
        $validator->add('url', [
            'required' => [
                'rule' => 'notBlank'
            ],
            'url' => [
                'rule' => 'url'
            ],
        ]);

        return $validator;
    }

}
