<?php

function redirect($uri)
{
    header('location: ' . ROOT . $uri);
}

function getCurrentDateTime()
{
    return date('Y-m-d H:i:s');
}

function isEmail($input)
{
    $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    return preg_match($pattern, $input);
}

function sanitizeInput($input)
{
    $sanitizedInput = trim($input);
    $sanitizedInput = stripslashes($sanitizedInput);
    $sanitizedInput = htmlspecialchars($sanitizedInput);
    return $sanitizedInput;
}

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function hashPasswordBcrypt($password)
{
    $options = ['cost' => 12];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
    return $hashedPassword;
}

function generateFakeUserAccount()
{
    $faker = Faker\Factory::create();
    $user = [
        "user_id" => $faker->uuid(),
        "email_address" => $faker->email(),
        "password" => $faker->password(12),
        "fullname" => $faker->name(),
        "address" => $faker->address()
    ];

    return $user;
}
