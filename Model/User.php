<?php

namespace app\Model;

use app\core\DbModel;

class User extends DbModel
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $confirmPassword;


    public function create()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

    public function rules()
    {
        return [
            "firstname" => [self::RULE_REQUIRED],
            "lastname" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public static function attributes()
    {
        return ['firstname', 'lastname', 'email', 'password'];
    }
}