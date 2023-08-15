<?php

namespace App;

use App\Models\Person;

class App 
{
    
    private array $argv;

    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }
    
    public function run(): void
    {
        if (count($this->argv) < 2) {
            $this->showError('Not enough arguments');
        }

        $argument = $this->argv[1];

        $task = $this->getTask($argument);

        if (count($this->argv) > 2 && $task !== 'runTask2') {
            $this->showError('Too many arguments');
        }

        if ($task === null || !method_exists($this, $task)) {
            $this->showError('Unknown command');
        }

        $this->$task();
    }

    private function getTask(string $argument): ?string
    {
        return match ($argument) {
            '1'     => 'runTask1',
            '2'     => 'runTask2',
            '3'     => 'runTask3',
            '4'     => 'runTask4',
            '5'     => 'runTask5',
            '6'     => 'runTask6',
            default => null,
        };
    }

    private function showError(string $errorText): never
    {
        echo 'Error: ' . $errorText;
        exit();
    }

    private function runTask1(): void
    {
        (new Person())->createTable();
    }

    private function runTask2(): void
    {
        if (count($this->argv) !== 5) {
            $this->showError('Wrong number of arguments');
        }

        $fullName  = $this->argv[2];
        $birthDate = $this->argv[3];
        $gender    = $this->argv[4];

        (new Person())->insertPerson(
            $fullName, $birthDate, $gender
        );
    }

    private function runTask3(): void
    {
        (new Person())->readUniquePersons();
    }

    private function runTask4(): void
    {
        $model = new Person();
        $model->insertMillionRecords();
        $model->insertHundredRecords();
    }

    private function runTask5(): void
    {
        (new Person())->readSpecialPersons();
    }

    private function runTask6(): void
    {
        $model = new Person();
        $model->createIndex();
        $model->readSpecialPersons();
    }

}