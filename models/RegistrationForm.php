<?php

namespace app\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    public string $name;
    public string $email;
    public string $password;
    public string $confirmPassword;
    public string $role;

    public function rules(): array
    {
        return [
            [['name', 'email', 'password', 'confirmPassword'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            ['password', 'string', 'min' => 6],
            ['role', 'in', 'range' => ['profy', 'user']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
            'role' => 'Role',
        ];
    }
}
