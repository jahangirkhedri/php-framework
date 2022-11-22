<?php

namespace app\Model;

class RegisterModel extends Model
{
    public string $firstname;
    public string $email;
    public string $password;
    public string $confirmPassword;


    public function create()
    {
        return true;
    }

    public function rules()
    {
        return [
            "firstname" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "password" => [self::RULE_REQUIRED,[self::RULE_MIN,'min'=>8]],
            "confirmPassword" => [self::RULE_REQUIRED,[ self::RULE_MATCH,'match'=>'password']],
        ];
    }
}