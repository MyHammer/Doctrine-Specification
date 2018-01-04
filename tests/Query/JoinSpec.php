<?php

namespace tests\Happyr\DoctrineSpecification\Query;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Query\Join;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Join
 */
class JoinSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('user', 'authUser', 'a');
    }

    public function it_is_a_specification()
    {
        $this->shouldHaveType('Happyr\DoctrineSpecification\Query\QueryModifier');
    }

    public function it_joins_with_default_dql_alias(QueryBuilder $qb)
    {
        $qb->join('a.user', 'authUser', null, null)->shouldBeCalled();
        $this->modify($qb, 'a');
    }

    public function it_uses_local_alias_if_global_was_not_set(QueryBuilder $qb)
    {
        $this->beConstructedWith('user', 'authUser');
        $qb->join('b.user', 'authUser', null, null)->shouldBeCalled();
        $this->modify($qb, 'b');
    }

    public function it_joins_with_string_condition_and_condition_type_WITH(QueryBuilder $qb)
    {
        $condition = "authUser.legacyId = a.legacyId";
        $conditionType = "WITH";
        $this->beConstructedWith('user', 'authUser', null, $conditionType, $condition);

        $qb->join('a.user', 'authUser', $conditionType, $condition)->shouldBeCalled();
        $this->modify($qb, 'a');
    }

    public function it_joins_with_string_condition_and_condition_type_ON(QueryBuilder $qb)
    {
        $condition = "authUser.legacyId = a.legacyId";
        $conditionType = "ON";
        $this->beConstructedWith('user', 'authUser', null, $conditionType, $condition);

        $qb->join('a.user', 'authUser', $conditionType, $condition)->shouldBeCalled();
        $this->modify($qb, 'a');
    }

    public function it_joins_with_string_condition_and_without_condition_type(QueryBuilder $qb)
    {
        $condition = "authUser.legacyId = a.legacyId";
        $this->beConstructedWith('user', 'authUser', null, null, $condition);

        $qb->join('a.user', 'authUser', null, $condition)->shouldBeCalled();
        $this->modify($qb, 'a');
    }
}
