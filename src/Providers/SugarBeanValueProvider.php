<?php

declare(strict_types=1);

namespace JojoSuiteCRM\Providers;

use JojoRender\Providers\ValueProviderInterface;

final class SugarBeanValueProvider implements ValueProviderInterface
{
    public function __construct(
        private readonly \SugarBean $bean,
    ) {
    }

    public function has(string $field): bool
    {
        return property_exists($this->bean, $field)
            || array_key_exists($field, $this->bean->fetched_row ?? []);
    }

    public function get(string $field): mixed
    {
        return $this->bean->$field ?? ($this->bean->fetched_row[$field] ?? null);
    }
}