<?php

declare(strict_types=1);

namespace Yiisoft\Db\Querys\Conditions;

use Yiisoft\Db\Exceptions\InvalidArgumentException;
use Yiisoft\Db\Expressions\ExpressionInterface;

/**
 * Class InCondition represents `IN` condition.
 */
class InCondition implements ConditionInterface
{
    private string $operator;
    private $column;
    private $values;

    public function __construct($column, string $operator, $values)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->values = $values;
    }

    /**
     * @return string the operator to use (e.g. `IN` or `NOT IN`).
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @return string|string[] the column name. If it is an array, a composite `IN` condition will be generated.
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @return ExpressionInterface[]|string[]|int[] an array of values that {@see column} value should be among. If it
     * is an empty array the generated expression will be a `false` value if {@see operator} is `IN` and empty if
     * operator is `NOT IN`.
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException if wrong number of operands have been given.
     */
    public static function fromArrayDefinition(string $operator, array $operands): self
    {
        if (!isset($operands[0], $operands[1])) {
            throw new InvalidArgumentException("Operator '$operator' requires two operands.");
        }

        return new static($operands[0], $operator, $operands[1]);
    }
}
