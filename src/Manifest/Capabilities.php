<?php
namespace HipChat\Manifest;

/**
 * Capabilities scope for HipChat manifests
 *
 * Handles the "capabilities" section of the root manifest document, while delegating the
 * validation rules to specialized objects for each type of capability
 *
 */
class Capabilities {

    /**
     * List of webhook capabilities
     *
     * @var array
     */
    protected $_webhooks = [];

    /**
     * List of action capabilities
     *
     * @var array
     */
    protected $_actions = [];

    /**
     * Return the keys required for a validation representation for the capabilities key in the
     * root manifest document
     *
     * @return array
     */
    public function output() {
        $output = [];
        $output['action'] = array_values($this->_actions);
        $output['webhook'] = array_values($this->_webhooks);

        $output = array_filter($output);

        return $output;
    }

    /**
     * Check if all handled capabilities are valid or not
     *
     * An exception will be thrown if a capability is not valid
     *
     * @return void
     */
    public function valid() {
        array_map(function($e) { $e->validate(); }, $this->_actions);
        array_map(function($e) { $e->validate(); }, $this->_webhooks);
    }

    /**
     * Add or get an Action capability object
     *
     * @param  string $identifier
     * @param  mixed $data
     * @return mixed
     */
    public function action($identifier, $data = null) {
        if (!array_key_exists($identifier, $this->_actions)) {
            $this->_actions[$identifier] = new Capability\Action();
        }

        if ($data !== null) {
            $this->_actions[$identifier]->apply($data);
        }

        return $this->_actions[$identifier];
    }

    public function dialog(Capability $dialog = null) {

    }

    public function glance(Capability $glance = null) {

    }

    public function apiConsumer(Capability $apiConsumer = null) {

    }

    /**
     * Add or get an Webhook capability object
     *
     * @param  string $identifier
     * @param  mixed $data
     * @return mixed
     */
    public function webhook($identifier, $data = null) {
        if (!array_key_exists($identifier, $this->_webhooks)) {
            $this->_webhooks[$identifier] = new Capability\Webhook();
        }

        if ($data !== null) {
            $this->_webhooks[$identifier]->apply($data);
        }

        return $this->_webhooks[$identifier];
    }

    public function installable(Capability $installable = null) {

    }

    public function internalChathook(Capability $internalChathook = null) {

    }

    public function oauth2Consumer(Capability $oauth2Consumer = null) {

    }

    public function oauth2Provider(Capability $oauth2Provider = null) {

    }

    public function webPanel(Capability $webPanel = null) {

    }

    public function externalPage(Capability $externalPage = null) {

    }

    public function adminPage(Capability $adminPage = null) {

    }

    public function configurable(Capability $configurable = null) {

    }

}
