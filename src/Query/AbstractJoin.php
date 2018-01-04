<?php

namespace Happyr\DoctrineSpecification\Query;

use Doctrine\ORM\QueryBuilder;

/**
 * @author Tobias Nyholm
 */
abstract class AbstractJoin implements QueryModifier
{
    protected const WITH = "WITH";
    protected const ON = "ON";

    /**
     * @var string field
     */
    private $field;

    /**
     * @var string alias
     */
    private $newAlias;

    /**
     * @var string dqlAlias
     */
    private $dqlAlias;

    /**
     * @var string
     */
    private $conditionType;

    /**
     * @var string
     */
    private $condition;

    /**
     * @param string $field
     * @param string $newAlias
     * @param string $dqlAlias
     * @param string $conditionType
     * @param string $condition
     */
    public function __construct($field, $newAlias, $dqlAlias = null, $conditionType = null, $condition = null)
    {
        $this->field = $field;
        $this->newAlias = $newAlias;
        $this->dqlAlias = $dqlAlias;
        $this->conditionType = $conditionType;
        $this->condition = $condition;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $dqlAlias
     */
    public function modify(QueryBuilder $qb, $dqlAlias)
    {
        if ($this->dqlAlias !== null) {
            $dqlAlias = $this->dqlAlias;
        }

        $join = $this->getJoinType();
        $qb->$join(sprintf('%s.%s', $dqlAlias, $this->field), $this->newAlias, $this->conditionType, $this->condition);
    }

    /**
     * Return a join type (ie a function of QueryBuilder) like: "join", "innerJoin", "leftJoin".
     *
     * @return string
     */
    abstract protected function getJoinType();
}
