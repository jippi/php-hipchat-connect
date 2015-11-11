<?php
namespace HipChat\Manifest;

/**
 * Generator for HipChat Connect (v2) manifests
 *
 */
class Generator extends AbstractNode {

    /**
     * Vendor object
     *
     * @var HipChat\Manifest\Vendor
     */
    public $_vendor;

    /**
     * Links object
     *
     * @var HipChat\Manifest\Vendor
     */
    public $_links;

    /**
     * Capabilities contriner
     *
     * @var HipChat\Manifest\Vendor
     */
    public $_capabilities;

    /**
     * Construct the output for displaying the manifest in the browser
     *
     * @return array
     */
    public function output() {
        $output = $this->attributes;
        $output['vendor'] = $this->_vendor->output();
        $output['links'] = $this->_links->output();
        $output['capabilities'] = $this->_capabilities->output();
        return $output;
    }

    /**
     * Check if the Generator + related resources is considered valid or not
     *
     * If any validation errors are found, an exception will be thrown
     *
     * @return void
     */
    public function valid() {
        parent::valid();
        $this->_vendor->valid();
        $this->_links->valid();
        $this->_capabilities->valid();
    }

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

        $validator->requirePresence('description');
        $validator->add('description', [
            'required' => ['rule' => 'notBlank'],
        ]);

        $validator->requirePresence('key');
        $validator->add('key', [
            'required' => ['rule' => 'notBlank'],
        ]);

        return $validator;
    }

    /**
     * Create or get the Vendor object
     *
     * @param  mixed $data
     * @return HipChat\Manifest\Vendor
     */
    public function vendor($data = null) {
        $this->_vendor = $this->_vendor ?: new Vendor();

        if ($data !== null) {
            $this->_vendor->apply($data);
        }

        return $this->_vendor;
    }

    /**
     * Create or get the Links object
     *
     * @param  mixed $data
     * @return HipChat\Manifest\Links
     */
    public function links($data = null) {
        $this->_links = $this->_links ?: new Links();

        if ($data !== null) {
            $this->_links->apply($data);
        }

        return $this->_links;
    }

    /**
     * Create or get the Capabilities container
     *
     * @param  mixed $data
     * @return HipChat\Manifest\Capabilities
     */
    public function capabilities($data = null) {
        $this->_capabilities = $this->_capabilities ?: new Capabilities();

        if ($data !== null) {
            $this->_capabilities->apply($data);
        }

        return $this->_capabilities;
    }

}
