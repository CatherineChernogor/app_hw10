<?php

namespace app;

class Order
{

    public $firstName;
    public $lastname;
    public $phone;
    public $email;
    public $theme;
    public $payment;
    public $notif;

    protected static $themes = [
        '1' => 'Бизнес',
        '2' => 'Технологии',
        '3' => 'Реклама и Маркетинг',
    ];
    protected static $payments = [
        '1' => 'WebMoney',
        '2' => 'Яндекс.Деньги',
        '3' => 'PayPal',
        '4' => 'кредитная карта'
    ];

    protected $errors;

    public function validate()
    {
        $errors = [];

        if (empty($this->firstName))
            $errors['firstName'] = 'First name is required';
        else if (strlen($this->firstName) < 2)
            $errors['firstName'] = 'First name is too short, must be at least 2 symbols';
        else if (strlen($this->firstName) > 50)
            $errors['firstName'] = 'First name is too long, must be less that 50 symbols';

        if (empty($this->lastname))
            $errors['lastname'] = 'Last name is required';
        else if (strlen($this->lastname) < 2)
            $errors['lastname'] = 'Last name is too short, must beat least 2 symbol';
        else if (strlen($this->lastname) > 50)
            $errors['lastname'] = 'LAst name is too long, must be less that 50 symbols';

        if (empty($this->phone))
            $errors['phone'] = 'Phone is required';

        if (empty($this->email))
            $errors['email'] = 'Email is required';

        if (empty($this->theme))
            $errors['theme'] = 'Theme is required';

        if (empty($this->payment))
            $errors['payment'] = 'Payment is required';

        //if (empty($this->notif))
        //$errors['notif'] = 'Must agree';

        $this->errors = $errors;

        return !$this->errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getThemes()
    {
        return static::$themes;
    }

    public function getPayments()
    {
        return static::$payments;
    }

    public function save()
    {
        $content = [];
        $content[] = uniqid();
        $content[] = date('Y-m-d H:i:s');
        $content[] = $_SERVER['REMOTE_ADDR'];
        $content[] = $this->firstName;
        $content[] = $this->lastname;
        $content[] = $this->phone;
        $content[] = $this->email;
        $content[] = $this->theme;
        $content[] = $this->payment;
        empty($this->notif) ? $content[] =  'нет' : $content[] = 'да';

        $filename = 'data.txt';

        $content = implode('||', $content) . "\n\r";
        file_put_contents($filename, $content, FILE_APPEND);

        return true;
    }

    public function fill($data)
    {

        $this->firstName = trim(strip_tags(array_get($data, 'firstName')));
        $this->lastname = trim(strip_tags(array_get($data, 'lastname')));
        $this->phone = trim(strip_tags(array_get($data, 'phone')));
        $this->email = trim(strip_tags(array_get($data, 'email')));
        $this->theme = trim(strip_tags(array_get($data, 'theme')));
        $this->payment = trim(strip_tags(array_get($data, 'payment')));
        $this->notif = trim(strip_tags(array_get($data, 'notif')));
    }
}
