<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NameProcessor extends Model
{
    public function processCsv($filePath)
    {
        $filePath = file($filePath);
        array_shift($filePath); // Exclude table header

        $namesArray = [];
        foreach ($filePath as $line) {
            $line = strtolower(trim($line));
            $line = str_replace('&', 'and', $line);

            $names = explode('and', $line);

            // checking if its single or multi owners
            if (count($names) === 1) {
                $person = $this->storeNameToArray(trim($names[0]));
                $namesArray[] = $person;
            } else {
                $person2 = $this->storeNameToArray(trim($names[1]));
                if (str_word_count(trim($names[0])) === 1) {
                    $person1 = [
                        'title' => ucfirst(trim($names[0])),
                        'initial' => strtoupper($person2['initial']) ?? null,
                        'first_name' => ucfirst($person2['first_name']) ?? null,
                        'last_name' => ucfirst($person2['last_name']) ?? null
                    ];
                    $namesArray[] = $person1;
                } else {
                    $person1 = $this->storeNameToArray(trim($names[0]));
                    $namesArray[] = $person1;
                }
                $namesArray[] = $person2;
            }
        }
        return $namesArray;
    }

    //assign single name to correct format
    public function storeNameToArray($name)
    {
        $nameParts = array_filter(explode(' ', trim($name)));

        switch (count($nameParts)) {
            case 2:
                return [
                    'title' => ucfirst($nameParts[0]),
                    'first_name' => null,
                    'initial' => null,
                    'last_name' => ucfirst($nameParts[1])
                ];
            case 3:
                $middlePart = preg_replace('/[^a-zA-Z]/', '', $nameParts[1]);

                if (strlen($middlePart) === 1) {
                    return [
                        'title' => ucfirst($nameParts[0]),
                        'first_name' => null,
                        'initial' => strtoupper($middlePart),
                        'last_name' => ucfirst($nameParts[2])
                    ];
                }

                return [
                    'title' => ucfirst($nameParts[0]),
                    'first_name' => ucfirst($nameParts[1]),
                    'initial' => null,
                    'last_name' => ucfirst($nameParts[2])
                ];
            default:
                return [];
        }
    }

}
