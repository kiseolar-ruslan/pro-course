<?php


use App\Core\Exceptions\ParameterNotFoundException;

class A
{
    public function getRandomVal(): int
    {
        if ($val = rand(1, 9) > 5) {
            throw new \Exception('Value > 5');
        }
        return $val;
    }

    /**
     * @param string $data
     * @return bool
     * @throws InvalidArgumentException
     */
    public function isEmail(string $data): bool
    {
        if (false === filter_var($data, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Not email');
        }
        return true;
    }

    public function sendMail(string $email): void
    {
        $this->isEmail($email);

        mail($email, 'subj', 'text');
    }

    public function sendSms(string $phone): void
    {
        //
    }
}


$a = new A();

//$email =  '+380979112233';
$email = 'qwe@gmail.com';

try {
    $a->sendMail($email);

    echo $a->getRandomVal();
} catch (InvalidArgumentException $e) {
    try {
    } catch (ParameterNotFoundException $e) {
    }


    $a->sendSms($email);
} catch (Exception $e) {
//    $logger = new Logger();
//    $logger->log($e->getMessage());
    echo 'ERROR: ' . $e->getMessage();
}

echo 'dfsfdsfgdsfdsfs';