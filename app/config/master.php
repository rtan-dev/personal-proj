<?php
/**
 * Created by PhpStorm.
 * User: Ralph
 * Date: 2/15/14
 * Time: 8:36 AM
 */
class Master
{
    public static function get($master_name, $id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException();
        }

        try {
            $row = $master_name::get($id);
        } catch(MasterRecordNotFoundException $e) {
            throw $e;
        }

        return $row;
    }

    public static function row($master_name, $conditions = array())
    {
        if (!is_array($conditions)) {
            throw new InvalidArgumentException();
        }

        try {
            $row = $master_name::row($conditions);
        } catch(MasterRecordNotFoundException $e) {
            throw $e;
        }

        return $row;
    }

    public static function rows($master_name, $conditions = array())
    {
        if (!is_array($conditions)) {
            throw new InvalidArgumentException();
        }

        try {
            $rows = $master_name::rows($conditions);
        } catch(MasterRecordNotFoundException $e) {
            throw $e;
        }

        return $rows;
    }
}