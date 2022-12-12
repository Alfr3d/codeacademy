<?php

namespace Processor\Service\Encoder;

class XmlEncoder implements EncoderInterface
{
    public function encode(array $data): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL;
        $xml .= '<products>' . PHP_EOL;
        foreach ($data as $category => $value) {
            $xml .= str_repeat(' ', 3) . '<' . $category . ' type="' . $value['type'] . '">' . PHP_EOL;
            foreach ($value['items'] as $item => $values) {
                $xml .= str_repeat(' ', 6) . '<' . $item . '>' . PHP_EOL;
                foreach ($values as $key => $value) {
                    $xml .= str_repeat(' ', 9) . '<' . $key . '>' . $value . '</' . $key . '>' . PHP_EOL;
                }
                $xml .= str_repeat(' ', 6) . '</' . $item . '>' . PHP_EOL;
            }
            $xml .= str_repeat(' ', 3) . '</' . $category . '>' . PHP_EOL;
        }
        $xml .= '</products>';

        return $xml;
    }
}