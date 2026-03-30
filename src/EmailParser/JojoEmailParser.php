<?php

declare(strict_types=1);

namespace JojoSuiteCRM\EmailParser;

use App\Emails\Service\EmailParserHandler\EmailParserInterface;
use JojoRender\Eval\EvaluationContext;
use JojoRender\Jojo;
use JojoSuiteCRM\Providers\SugarBeanValueProvider;

final class JojoEmailParser implements EmailParserInterface
{
    public function __construct(
        private readonly Jojo $jojo,
    ) {
    }

    public function getKey(): string
    {
        return 'jojo';
    }

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

    public function parse(string $string, \SugarBean $bean, bool $replaceEmpty = true): string
    {
        $context = new EvaluationContext();
        $context->addProvider('bean', new SugarBeanValueProvider($bean));

        return $this->jojo->render($string, $context);
    }
}