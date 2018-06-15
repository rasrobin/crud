<?php

namespace Rasrobin\Crud;

/**
 * Interface ColumnInterface
 */
interface ColumnInterface
{
    /**
     * Machine name
     *
     * @return string
     */
    public function getId();

    /**
     * Human readable name
     *
     * @return string
     */
    public function getName();

    /**
     * Process method to create columns processing the appearance of values.
     *
     * @param string|null $value
     * @return string
     */
    public function processValue($value);

    /**
     * Array of classes to be on the column
     * @return string[]
     */
    public function getClasses();

    /**
     * @param string $class
     */
    public function addClass($class);

    /**
     * @param string $class
     */
    public function removeClass($class);

    /**
     * Adds/removes the right classes to sort a table by this column
     *
     * @param string $order
     */
    public function sort($order);

    /**
     * Returns whether the table is ordered by this column
     *
     * @return boolean
     */
    public function getOrderBy();

    /**
     * Either asc or desc.
     *
     * @return string
     */
    public function getOrder();

    /**
     * @return string
     */
    public function getNewOrder();

    /**
     * reverses the order value
     */
    public function inverseOrder();

    /**
     * Tells if this is a default crud column
     *
     * @return boolean
     */
    public function isDefaultColumn();

    /**
     * Creates a default crud column or a regular one if the id doesn't match
     *
     * @param $id
     * @return $this
     */
    public static function createDefaultColumn($id);

    /**
     * Factory method to create a new column
     *
     * @param $id
     * @return $this
     */
    public static function createColumn($id);
}