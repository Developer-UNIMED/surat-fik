<?php

namespace App\Helper;

use Illuminate\Support\Str;

class StringUtils
{
    /**
     * Generate random string with specified length
     * this function will generate random string by shuffling the UUID
     * @param int $length
     * @param string $generator 'uuid' | 'ulid' | 'random'
     * @return string
     */
    public static function random(int $length, string $generator = 'uuid'): string
    {
        $genFunction = match ($generator) {
            'uuid' => fn() => Str::uuid(),
            'ulid' => fn() => Str::ulid(),
            default => fn() => Str::random($length),
        };

        // regex to remove all non-alphanumeric characters
        $pattern = '/[^a-zA-Z0-9]/';
        // generate the string to count the length
        $strings = preg_replace($pattern, '', $genFunction());
        $generatedLength = strlen($strings);

        // repeat the string until it reaches the length
        $iteration = ceil($length / $generatedLength);
        for ($i = 1; $i < $iteration; $i++) {
            $strings .= preg_replace($pattern, '', $genFunction());
        }

        // shuffle the string
        $strings = str_shuffle($strings);
        // return the substring of the string
        return substr($strings, 0, $length);
    }

    /**
     * Sanitize name by removing all title.
     * @param string $name
     * @return string
     */
    public static function sanitizeName(string $name): string
    {
        $regexes = [
            // Remove titles from name (not working for some titles)
            '/(\w{2,}+\.( )+)|(, \w.*)/i',
            // NOTE: have to do this twice because some titles is not removed by the first regex
            '/\b(?:H\.|Prof\.?|Dr\.?|Ir\.?|S\.?Kom|M\.?Sc\.?|Ph\.?D\.?|Eng\.?)\.?\s*|(?<=\s)[A-Z]\.\s*/i',
        ];

        foreach ($regexes as $regex) {
            // remove titles from name using regex
            $name = preg_replace($regex, '', $name);
        }

        // remove extra spaces from regex replacement
        return trim(preg_replace('/\s+/', ' ', $name));
    }

    /**
     * Remove titles and return first and last name from full name.
     * Will return null if both first and last name are empty or bad input.
     * @param string $fullName
     * @return array|null
     */
    public static function getFirstAndLastName(string $fullName): array|null
    {
        $sanitizedName = self::sanitizeName($fullName);
        // split the name
        $nameParts = explode(' ', $sanitizedName);
        // get first name
        $firstName = $nameParts[0];
        // get lastName by joining the rest of the name
        $lastName = implode(' ', array_slice($nameParts, 1));

        // this is a bad input
        if (empty($firstName) && empty($lastName)) {
            return null;
        }

        // if first name is empty, swap the first name with last name
        $firstName ??= $lastName;
        // if last name is empty, swap the last name with first name
        $lastName ??= $firstName;

        return [$firstName, $lastName];
    }

    /**
     * Normalize phone number by removing all non-numeric characters
     * and limit it to 13 characters.
     * @param string $phoneNumber
     * @return string
     */
    public static function normalizePhoneNumber(string $phoneNumber): string
    {
        $phoneNumber = match (true) {
            str_starts_with($phoneNumber, '62') => '0' . substr($phoneNumber, 2),
            str_starts_with($phoneNumber, '+62') => '0' . substr($phoneNumber, 3),
            default => $phoneNumber,
        };

        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        return substr($phoneNumber, 0, 13);
    }
}
