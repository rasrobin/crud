<?php

namespace Rasrobin\Crud\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Rasrobin\Crud\Column;
use Rasrobin\Crud\HasCrud;

/**
 * Extend your Controller to this one to add Crud functionality
 *
 * Abstract Class CrudController
 */
Abstract class CrudController extends Controller
{
    use ValidatesRequests;
    use AuthorizesRequests;

    /**
     * describes the number of entities shown on one page.
     * Can be overwritten if you set $this->paginate.
     */
    const PAGINATE = 3;
    const DEFAULT_ORDER_BY = 'created_at';

    /**
     * @var HasCrud $model
     */
    public $model;

    /**
     * @var string $routeResource
     */
    public $routeResource;

    /**
     * @var Request $request
     */
    public $request;

    /**
     * CrudController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->routeResource = $request->route() ? preg_split('[\.]',$request->route()->getName())[0] : '';
    }

    /**
     * Display a paginated overview of all entities of a given model
     *
     * @return View
     */
    public function index()
    {
        $order = $this->request->input('order');
        $orderBy = $this->request->input('orderby');

        if ($order === null) {$order = Column::ORDER_DEFAULT;}
        if ($orderBy === null) {$orderBy = self::DEFAULT_ORDER_BY;}
        $paginate = (empty($this->paginate)) ? self::PAGINATE : $this->paginate;

        $data['entities'] = $this->getEntities()->orderBy($orderBy, $order)->paginate($paginate);
        $data['model'] = $this->model;
        $data['routeResource'] = $this->routeResource;
        $data['orderBy'] = $orderBy;
        $data['order'] = $order;
        $data['page'] = (intval($this->request->input('page'))) ?: 1;

        if($this->request->ajax()) {
            return view('rasrobin\crud::overview_ajax', $data)->render();
        }

        return view('rasrobin\crud::overview', $data);
    }

    /**
     * Returns all or a selection of HasCrud entities.
     *
     * @return HasCrud
     */
    public function getEntities()
    {
        return $this->model::select('*');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return View
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->model::crudFormValidation());

        $this->model::createByForm($this->request);

        return redirect()->route($this->routeResource . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $data['model'] = $this->model;
        $data['routeResource'] = $this->routeResource;

        return view('rasrobin\crud::create', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $this->model::findOrFail($id)->delete();

        return redirect()->route($this->routeResource . '.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, $this->model::crudFormValidation());

        $this->model::updateByForm($this->request, $id);

        return redirect()->route($this->routeResource . '.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        $data['entity'] = $this->model::findOrFail($id);
        $data['model'] = $this->model;
        $data['routeResource'] = $this->routeResource;
        $data['fields'] = $this->extractFieldsArray($this->model::crudColumns());

        return view('rasrobin\crud::show', $data);
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id)
    {
        $data['entity'] = $this->model::findOrFail($id);
        $data['model'] = $this->model;
        $data['routeResource'] = $this->routeResource;

        return view('rasrobin\crud::edit', $data);
    }

    /**
     * Remove the view, edit and delete columns from array
     *
     * @param array $columnArray
     *
     * @return array
     *     Return an array of fields.
     */
    protected function extractFieldsArray(array $columnArray)
    {
        $removeColumns = [
            Column::VIEW,
            Column::EDIT,
            Column::DELETE
        ];

        foreach ($columnArray as $key => $column) {
            if (in_array($column->getId(), $removeColumns)) {
                unset($columnArray[$key]);
            }
        }

        return $columnArray;
    }
}