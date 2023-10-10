<?php


class SomeClass
{
    protected DateTime $date;

    protected int $a = 1;
    protected int $b = 2;

    public function __construct(protected string $name)
    {
        $this->date = new DateTime();
    }

    public function printHello(): void
    {
        echo 'Hello' . PHP_EOL;
    }

    public function printHelloUser(): void
    {
        echo 'Hello, ' . $this->name . PHP_EOL;
    }

    public function __destruct()
    {
//        echo 'Object removed' . PHP_EOL;
    }

    /**
     * @return int
     */
    public function getA(): int
    {
        return $this->a;
    }

    /**
     * @param int $a
     */
    public function setA(int $a): void
    {
        $this->a = $a;
    }

    /**
     * @return int
     */
    public function getB(): int
    {
        return $this->b;
    }

    /**
     * @param int $b
     */
    public function setB(int $b): void
    {
        $this->b = $b;
    }

    public function __serialize(): array
    {
        return [
            'a'   => $this->a,
            'b'   => $this->b,
            //            'date' => $this->date->format('d.m.Y H:i:s'),
            'ddd' => 11111111
        ];
    }

    public function __unserialize(array $data): void
    {
//        $this->a = $data['a'];
//        $this->b = $data['b'];
//        $this->date = new DateTime($data['date']);

    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function __invoke(): string
    {
        return $this->a;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getDateString(): string
    {
        return $this->date->format('d.m.Y H:i:s');
    }


}

$o = new SomeClass('Ivan');

$a = clone $o;


echo $o->getDateString();
$aa = 1;