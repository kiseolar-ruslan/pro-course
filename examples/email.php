<?php


class Email
{

    public function __construct(protected string $email)
    {
        $this->validate();
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    protected function validate(): bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email не валідний');
        }
        return true;
    }
}


try {
    $emailObj  = new Email('example@gmail.com');
    $emailObj2 = new Email('example2@gmail.com');
    $emailObj3 = new Email('example3@gmail.com');
    $emailObj4 = new Email('example4@gmail.com');
    $emailObj5 = new Email('example5@gmail.com');


    if (mail($emailObj->getEmail(), 'subj', 'Hello')) {
        echo 'Відправлено';
    } else {
        echo 'Не відправлено';
    }
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}


echo PHP_EOL;
echo '====== Кінець програми ======';
echo PHP_EOL;
