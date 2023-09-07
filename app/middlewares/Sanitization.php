<?php

class Sanitization
{
    public function handle($request)
    {
        $validatedData = $this->validate($request);

        return $validatedData;
    }

    private function validate($data)
    {
        $validatedData = [];

        foreach ($data as $key => $value) {
            $sanitizedValue = $this->sanitize($value);
            $validatedData[$key] = $sanitizedValue;
        }
    }

    private function sanitize($input)
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}
