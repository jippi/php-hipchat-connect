<?php
namespace HipChat\Manifest;

use Cake\Validation\Validator;
use HipChat\Exception\UnknownAttributeException;
use HipChat\Exception\ValidationException;
use JsonSerializable;

/**
 * Abstract node object for manging data and attributes
 *
 */
class AbstractNode implements JsonSerializable {

    /**
     * List of attributes for the current scope
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Cached instance of the Validator instance
     *
     * @var \Cake\Validation\Validator
     */
    protected $validator;

    /**
     * Constructor
     *
     * @param array|null $data
     */
    public function __construct(array $data = null) {
        if ($data !== null) {
            $this->apply($data);
        }
    }

    /**
     * Return the attributes needed for a valid representation of the node
     *
     * @return array
     */
    public function output() {
        return $this->attributes;
    }

    /**
     * Validate the current node data against the node validation rules
     *
     * An exception is thrown if there is any validation errors
     *
     * @param  array|null $data
     * @return void
     */
    public function validate(array $data = null) {
        if ($data === null) {
            $data = $this->attributes;
        }

        $validator = $this->validator();
        $result = $validator->errors($data);
        if (!empty($result)) {
            $exception = new ValidationException(sprintf('Node "%s" could not validate', static::class));
            $exception->validationErrors = $errors;
            throw $exception;
        }
    }

    /**
     * Construct validation rules for the current scope
     *
     * @return Cake\Validation\Validator
     */
    public function validator() {
        if (!$this->validator) {
            $this->validator = $this->newValidator();
        }

        return $this->validator;
    }

    /**
     * Get a new Validator instance
     *
     * @return Cake\Validation\Validator
     */
    public function newValidator() {
        return new Validator();
    }

    /**
     * Mass-set a list of key/values
     *
     * @param  array  $data
     * @return self
     */
    public function apply(array $data) {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * Set a key to a specific value, if the value is correct
     *
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value) {
        $validator = $this->validator();
        if (!$validator->hasField($key)) {
            throw new UnknownAttributeException(sprintf('Node "%s" does not allow attribute "%s"', static::class, $key));
        }

        $errors = $validator->errors([$key => $value]);
        if (!empty($errors[$key])) {
            $exception = new ValidationException(sprintf('Node "%s" could not validate attribute "%s"', static::class, $key));
            $exception->validationErrors = $errors;
            throw $exception;
        }

        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Get the value for a specific attribute key
     *
     * @param  string $key
     * @return mixed
     */
    public function get($key) {
        $validator = $this->validator();
        if (!$validator->hasField($key)) {
            throw new UnknownAttributeException(sprintf('Node "%s" does not allow attribute "%s"', static::class, $key));
        }

        return $this->attributes[$key];
    }

    /**
     * Magic getter for faking properties
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key) {
       return $this->get($key);
    }

    /**
     * Magic setter for faking properties
     *
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    public function __set($key, $value) {
        return $this->set($key, $value);
    }

    /**
     * Allow a quick serialization of the object hierarchy
     *
     * @return string
     */
    public function jsonSerialize() {
        return $this->output();
    }

}
