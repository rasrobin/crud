<?php

namespace Rasrobin\Crud;

/**
 * Interface DateTimeColumnInterface
 */
interface DateTimeColumnInterface extends ColumnInterface
{
    /**
     * Set the datetime format.
     *
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format);

    /**
     * Get the datetime format.
     *
     * @return string
     */
    public function getFormat();
}