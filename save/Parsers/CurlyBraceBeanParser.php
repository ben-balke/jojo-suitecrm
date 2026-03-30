<?php
namespace App\Emails\Service\EmailParserHandler\Parsers;
use App\Emails\Service\EmailParserHandler\EmailParserInterface;

class CurlyBraceBeanParser implements EmailParserInterface
{

    public const KEY = 'curly-email-parser';
    public function getModule(): string
    {
        return 'default';
    }

    public function getOrder(): int
    {
        return 5;
    }

    public function applies(): bool
    {
        return true;
    }

    public function getKey(): string
    {
        return self::KEY;
    }

    public function parse(string $string, $bean, bool $replaceEmpty = true): string
    {
        return preg_replace_callback('/\{\{\s*([a-zA-Z0-9_]+)\s*\}\}/', function ($m) use ($bean, $replaceEmpty) {
            $field = $m[1];
            $value = $bean->$field ?? ($bean->fetched_row[$field] ?? '');

            if ($value === '' && !$replaceEmpty) {
                return $m[0];
            }

            return is_scalar($value) ? (string)$value : '';
        }, $string);
    }
}