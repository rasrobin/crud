<?php

namespace Rasrobin\Crud;

/**
 * Class Column
 */
class Column implements ColumnInterface
{
    /**
     * Order constants
     */
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    const ORDER_DEFAULT = self::ORDER_DESC;

    /**
     * Default columns
     */
    const ID = 'id';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $classes;

    /**
     * @var boolean
     */
    protected $orderBy;

    /**
     * @var string
     */
    protected $order;

    /**
     * Column constructor.
     */
    public function __construct()
    {
        $this->orderBy = false;
        $this->name = '';
        $this->classes = [];
        $this->order = Column::ORDER_ASC;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return string
     */
    public function processValue($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * {@inheritdoc}
     */
    public function addClass($class)
    {
        $this->classes[] = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function removeClass($class)
    {
        unset($this->classes[$class]);
    }

    /**
     * {@inheritdoc}
     */
    public function sort($order)
    {
        $this->order = $order;

        if ($this->orderBy === false) {
            $this->orderBy = true;
            $this->addClass($this->getOrder());
        } else {
            $this->removeClass($this->getOrder());
            $this->inverseOrder();
            $this->addClass($this->getOrder());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewOrder()
    {

        if ($this->orderBy === true and $this->order === Column::ORDER_ASC) {
            return Column::ORDER_DESC;
        }

        return Column::ORDER_ASC;
    }

    /**
     * {@inheritdoc}
     */
    public function inverseOrder()
    {
        if ($this->order === Column::ORDER_ASC) {
            $this->order = Column::ORDER_DESC;
        }

        $this->order = Column::ORDER_ASC;
    }

    /**
     * {@inheritdoc}
     */
    public function isDefaultColumn() {
        if (in_array($this->id, [
            Column::ID,
            Column::VIEW,
            Column::EDIT,
            Column::DELETE,
        ])) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public static function createDefaultColumn($id)
    {
        $column = new self;
        $column->id = $id;

        if (!$column->isDefaultColumn()) {
            return false;
        }

        if ($id === Column::ID) {
            $column->name = 'ID';
            $column->order = Column::ORDER_DESC;
        }

        return $column;
    }

    /**
     * {@inheritdoc}
     */
    public static function createColumn($id, $name = '', $classes = [], $orderReverse = false)
    {
        $column = new static;
        $column->id = $id;
        $column->name = $name;
        $column->classes = $classes;

        if ($orderReverse === true) {
            $column->order = Column::ORDER_DESC;
        }

        return $column;
    }
}