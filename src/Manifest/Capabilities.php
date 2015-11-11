<?php
namespace HipChat\Manifest;

use HipChat\Exception\NotImplementedCapabilityException;

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
     * List of dialog capabilities
     *
     * @var array
     */
    protected $_dialogs = [];

    /**
     * List of dialog capabilities
     *
     * @var array
     */
    protected $_glances = [];

    /**
     * List of installable capabilities
     *
     * @var HipChat\Capabilities\InstallableCapability
     */
    protected $_installable;

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
        $output['dialog'] = array_values($this->_dialogs);
        $output['glance'] = array_values($this->_glances);
        $output['installable'] = $this->_installable;

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
        array_map(function($e) { $e->validate(); }, $this->_dialogs);
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
            $this->_actions[$identifier] = new Capability\ActionCapability();
        }

        if ($data !== null) {
            $this->_actions[$identifier]->apply($data);
        }

        return $this->_actions[$identifier];
    }

    /**
     * Add or get an Dialog capability object
     *
     * @param  string $identifier
     * @param  mixed $data
     * @return mixed
     */
    public function dialog($identifier, $data = null) {
        if (!array_key_exists($identifier, $this->_dialogs)) {
            $this->_dialogs[$identifier] = new Capability\DialogCapability();
        }

        if ($data !== null) {
            $this->_dialogs[$identifier]->apply($data);
        }

        return $this->_dialogs[$identifier];
    }

    /**
     * Add or get an Glance capability object
     *
     * @param  string $identifier
     * @param  mixed $data
     * @return mixed
     */
    public function glance($identifier, $data = null) {
        if (!array_key_exists($identifier, $this->_glances)) {
            $this->_glances[$identifier] = new Capability\GlanceCapability();
        }

        if ($data !== null) {
            $this->_glances[$identifier]->apply($data);
        }

        return $this->_glances[$identifier];
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
            $this->_webhooks[$identifier] = new Capability\WebhookCapability();
        }

        if ($data !== null) {
            $this->_webhooks[$identifier]->apply($data);
        }

        return $this->_webhooks[$identifier];
    }

    /**
     * Access the installable capability handler object
     *
     * @return HipChat\Capability\InstallableCapability
     */
    public function installable() {
        return $this->_installable = $this->_installable ?: new Capability\InstallableCapability();
    }

    public function apiConsumer(Capability $apiConsumer = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function internalChathook(Capability $internalChathook = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function oauth2Consumer(Capability $oauth2Consumer = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function oauth2Provider(Capability $oauth2Provider = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function webPanel(Capability $webPanel = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function externalPage(Capability $externalPage = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function adminPage(Capability $adminPage = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

    public function configurable(Capability $configurable = null) {
        throw new NotImplementedCapabilityException(__METHOD__ . ' capability is not implemented yet');
    }

}
