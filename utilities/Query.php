<?php

class Query {

    private $sql;
    private $args;

    public static function createUpdateFromArray($table, $args, $conditionField) {
        $conditionFieldArgs = ':' . $conditionField;
        $sql = 'UPDATE ' . $table . ' SET ';
        $argsPrepare = array();
        foreach($args as $key => $value) {
            if(isset($value) && !empty($value)) {
                if($key != $conditionFieldArgs) {
                    $sql .= substr($key, 1, strlen($key)) . " = " . $key . ", ";
                }
                $argsPrepare[$key] = $value;
            }
        }
        $sql = substr_replace($sql, ' WHERE ' . $conditionField . ' = ' . $conditionFieldArgs, -2);
        $query = new Query();
        $query->setSql($sql);
        $query->setArgs($argsPrepare);
        return $query;
    }

    public function getSql()
    {
        return $this->sql;
    }

    public function setSql($sql)
    {
        $this->sql = $sql;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public function setArgs($args)
    {
        $this->args = $args;
    }

}