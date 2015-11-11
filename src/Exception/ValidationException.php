<?php
namespace HipChat\Exception;

class ValidationException extends HipChatException {

    public $validationErrors;

    public function getValidationErrorCount() {
        return count($validationErrors);
    }

    public function getValidationErrors() {
        return $validationErrors;
    }

}
