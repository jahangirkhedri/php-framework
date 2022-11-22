<?php

namespace app\Model;

use app\core\Application;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public const ERORR_MESSAGES = [
        self::RULE_REQUIRED => 'This field must be required',
        self::RULE_EMAIL => 'This email is invalid.',
        self::RULE_MIN => 'min length of this field must be {min}',
        self::RULE_MAX => 'max length of this field must be {max}',
        self::RULE_MATCH => 'match',
        self::RULE_UNIQUE => 'this field must be unique',
    ];

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value)
                    $this->addErrorByRule($attribute, self::RULE_REQUIRED);

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                    $this->addErrorByRule($attribute, self::RULE_EMAIL);

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min'])
                    $this->addErrorByRule($attribute, self::RULE_MIN, $rule);

                if ($ruleName === self::RULE_MAX && strlen($value) < $rule['max'])
                    $this->addErrorByRule($attribute, self::RULE_MAX, $rule);

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']})
                    $this->addErrorByRule($attribute, self::RULE_MATCH, $rule);

                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $db = Application::$app->db;
                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorByRule($attribute, self::RULE_UNIQUE);
                    }
                }

            }

        }
        return empty($this->errors);
    }

    abstract public function rules();

    public function addError(string $attribute, string $ruleName, $params = [])
    {
        $message = self::ERORR_MESSAGES[$ruleName] ?? '';
        foreach ($params as $key => $param) {
            $message = str_replace("{{$key}}", $param, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    protected function addErrorByRule(string $attribute, string $rule, $params = [])
    {
        $params['field'] ??= $attribute;
        $errorMessage = $this->errorMessage($rule);
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }
    public function errorMessage($rule)
    {
        return self::ERORR_MESSAGES[$rule];
    }




}