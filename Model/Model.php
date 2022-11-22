<?php

namespace app\Model;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public const ERORR_MESSAGES = [
        self::RULE_REQUIRED => 'required',
        self::RULE_EMAIL => 'email',
        self::RULE_MIN => 'min length of this field must be {min}',
        self::RULE_MAX => 'max',
        self::RULE_MATCH => 'match',
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
                    $this->addError($attribute, self::RULE_REQUIRED);

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                    $this->addError($attribute, self::RULE_EMAIL);

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min'])
                    $this->addError($attribute, self::RULE_MIN, $rule);

                if ($ruleName === self::RULE_MAX && strlen($value) < $rule['max'])
                    $this->addError($attribute, self::RULE_MAX, $rule);

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']})
                    $this->addError($attribute, self::RULE_MATCH, $rule);

            }

        }
        return empty($this->errors);
    }

    abstract public function rules();

    public function addError(string $attribute, string $ruleName, $params = [])
    {
        $message = self::ERORR_MESSAGES[$ruleName] ?? '';
        foreach ($params as $key => $param) {
            $message =str_replace("{{$key}}",$param,$message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

}