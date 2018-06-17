<?php

namespace Rasrobin\Crud;

use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use \ArrayAccess;

interface HasCrud extends ArrayAccess, Arrayable, Jsonable, QueueableEntity, UrlRoutable
{
    /**
     * Name of a single entity of the model
     *
     * @return string
     */
    public function getName();

    /**
     * Columns being used in the model's overview page
     *
     * @return ColumnInterface[]
     */
    public static function crudColumns();

    /**
     * @return []
     */
    public static function crudFormValidation();

    /**
     * Location of the form Template
     * example: rasrobin/crm::customer_form
     *
     * @return string
     */
    public static function crudFormTemplate();

    /**
     * Main title for the crud pages of this model
     *
     * @return string
     */
    public static function crudTitle();

    /**
     * Lowercase, human readable description of the entity of the model
     *
     * @return string
     */
    public static function crudEntityName();

    /**
     * @param Request $request
     */
    public static function createByForm(Request $request);

    /**
     * @param Request $request
     * @param int $id
     */
    public static function updateByForm(Request $request, int $id);
}