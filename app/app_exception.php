<?php
class AppException extends Exception
{
}

class ValidationException extends AppException
{
}

class RecordNotFoundException extends AppException
{
}

class ServiceNotFoundException extends AppException
{
}

class NotEnoughMaterialsException extends AppException
{
}

class ItemExistsException extends AppException
{
}

class MasterRecordNotFoundException extends AppException
{
}

class MasterRecordConditionNotFoundException extends AppException
{
    public function __construct($called_class, $conditions)
    {
        $conditions_string = $this->getConditionsAsString($conditions);
        $message = '[' . $called_class . '] ' . 'no records found with conditions: ' . $conditions_string;

        parent::__construct($message);
    }

    /**
     * 配列から、key (value), key (value)のような文字列を返す
     * @param array $conditions
     * @return string
     */
    protected function getConditionsAsString($conditions = array())
    {
        if (!$conditions) {
            return 'condition is empty.';
        }

        $string = '';
        foreach($conditions as $key=>$value) {
            $string .= "$key ($value),";
        }

        return $string;
    }
}
