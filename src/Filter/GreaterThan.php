<?php

namespace Happyr\DoctrineSpecification\Filter;

class GreaterThan extends Comparison
{
    /**
     * @param string $field
     * @param string $value
     * @param string $dqlAlias
     */
    public function __construct($field, $value, $dqlAlias = null)
    {
        parent::__construct(self::GT, $field, $value, $dqlAlias);
    }
}
