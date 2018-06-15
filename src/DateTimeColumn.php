<?php

namespace Rasrobin\Crud;
use Carbon\Carbon;

/**
 * Class DateTimeColumn
 */
class DateTimeColumn extends Column implements DateTimeColumnInterface
{
    /**
     * Defines the format in which de value has to be
     *
     * @var
     */
    protected $format;

    /**
     * {@inheritdoc}
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * {@inheritdoc}
     */
    public function processValue($value)
    {
        if ($value === null) {
           parent::processValue($value);
        }

        return Carbon::parse($value)->format($this->format);
    }
}