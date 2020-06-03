<?php

namespace app;

class Order extends Model
{
    protected static $table = 'participants';
    protected static $columns = [
        'id',
        'ip',
        'firstname',
        'lastname',
        'phone',
        'email',
        'subject_id` as `theme',
        'payment_id` as `payment',
        'mailing',
        'created_at',
        'deleted_at',
    ];

    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    public $theme;
    public $payment;
    public $mailing;

    public $id;
    public $created_at;
    public $ip;
    public $deleted_at;

    protected $errors;

    protected static $themes = [];
    protected static $payments = [];

    public function __construct()
    {
        $this->loadPayments();
        $this->loadThemes();
    }
    protected function LoadPayments()
    {
        if (!count(static::$payments)) {
            $payments = Payment::loadAll();

            foreach ($payments as $payment) {
                static::$payments[$payment->id] = $payment->name;
            }
        }
    }

    protected function loadThemes()
    {
        if (!count(static::$themes)) {
            $themes = Theme::loadAll();

            foreach ($themes as $theme) {
                static::$themes[$theme->id] = $theme->name;
            }
        }
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

    public function validate()
    {
        $errors = [];

        if (empty($this->firstname))
            $errors['firstname'] = 'First name is required';
        else if (strlen($this->firstname) < 2)
            $errors['firstname'] = 'First name is too short, must be at least 2 symbols';
        else if (strlen($this->firstname) > 50)
            $errors['firstname'] = 'First name is too long, must be less that 50 symbols';
        else if (!preg_match('/^[А-ЯЁ][а-яё]{1,24}$/u', $this->firstname))
            $errors['firstname'] = 'Incorrect value';

        if (empty($this->lastname))
            $errors['lastname'] = 'Last name is required';
        else if (strlen($this->lastname) < 2)
            $errors['lastname'] = 'Last name is too short, must beat least 2 symbol';
        else if (strlen($this->lastname) > 50)
            $errors['lastname'] = 'Last name is too long, must be less that 50 symbols';
        else if (!preg_match('/^[А-ЯЁ]([а-яё\-]){0,24}$/u', $this->lastname))
            $errors['lastname'] = 'Incorrect value';

        if (empty($this->phone))
            $errors['phone'] = 'Phone is required';
        else if (!preg_match('/^\+7\s?9\d{2}\s?\d{3}\-?\d{2}\-?\d{2}$/', $this->phone))
            $errors['phone'] = 'Incorrect value';

        if (empty($this->email))
            $errors['email'] = 'Email is required';
        else if (!preg_match('/^[a-zA-Z\d_\-\.]+@[a-z\-]{2,15}\.[a-z]{2,6}$/', $this->email))
            $errors['email'] = 'Incorrect value';

        if (empty($this->theme))
            $errors['theme'] = 'Theme is required';

        if (empty($this->payment))
            $errors['payment'] = 'Payment is required';

        //if (empty($this->mailing))
        //$errors['mailing'] = 'Must agree';

        $this->errors = $errors;

        return !$this->errors;
    }

    public function save()
    {

        $db = Database::getPdo();

        $sql = $db->prepare('insert into `participants` (
            `ip`, `firstname`, `lastname`, `phone`, `email`,
            `subject_id`, `payment_id`, `mailing`, `created_at`
            ) 
        values (
            :ip, :firstname, :lastname, :phone, :email, 
            :subject_id, :payment_id, :mailing, :created_at
            )');

        $sql->execute([
            ':ip' => $this->ip,
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':phone' => preg_replace('/^\+7\s?(9\d{2})\s?(\d{3})\-?(\d{2})\-?(\d{2})$/', '+7 $1 $2-$3-$4', $this->phone),
            ':email' => $this->email,
            ':subject_id' => $this->theme,
            ':payment_id' => $this->payment,
            ':mailing' => !!$this->mailing,
            ':created_at' => $this->created_at,
        ]);

        return $sql->rowCount() === 1;
    }

    public function fill($data)
    {
        $this->id = uniqid();
        $this->created_at = date('Y-m-d H:i:s');
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->firstname = trim(strip_tags(array_get($data, 'firstname')));
        $this->lastname = trim(strip_tags(array_get($data, 'lastname')));
        $this->phone = trim(strip_tags(array_get($data, 'phone')));
        $this->email = trim(strip_tags(array_get($data, 'email')));
        $this->theme = trim(strip_tags(array_get($data, 'theme')));
        $this->payment = trim(strip_tags(array_get($data, 'payment')));
        $this->mailing = trim(strip_tags(array_get($data, 'mailing')));
    }

    public function read($filename)
    {
        $contents = file_get_contents($filename);
        $contents = trim($contents);

        $items = explode("\n", $contents);

        $data = [];

        foreach ($items as $item) {

            $item = trim($item);
            $cols = explode('||', $item);

            $data[$cols[0]] = [
                'created_at'      => $cols[1],
                'ip'        => $cols[2],
                'firstname' => $cols[3],
                'lastname'  => $cols[4],
                'phone'     => $cols[5],
                'email'     => $cols[6],
                'theme'     => $this->getThemes()[$cols[7]],
                'payment'   => $this->getPayments()[$cols[8]],
                'mailing'     => $cols[9],
            ];
        }
        return $data;
    }

    public static function deleteById($id)
    {
        $db = Database::getPdo();

        $time = date('Y-m-d H:i:s');
        $sql = $db->prepare("UPDATE `participants` SET `deleted_at` = '$time' WHERE `id` = :id LIMIT 1 ");

        $sql->execute([':id' => $id]);
        return true;
    }
}
