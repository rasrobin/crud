<table class="table" width="80%">
    <thead>
    <tr>
        <?php /* @var \Rasrobin\Crud\ColumnInterface $column */ ?>
        @foreach ($model::crudColumns() as $column)
            <?php
            if ($orderBy === $column->getId()) {
                $column->sort($order);
            }
            ?>
            @if($column->getId() === \Rasrobin\Crud\Column::ID or !$column->isDefaultColumn())
                <th
                        class="border-top-0 {{ implode(' ', $column->getClasses()) }}"
                        data-id="{{ $column->getId() }}"
                        data-order="{{ $column->getOrder() }}"
                        data-new-order="{{ $column->getNewOrder() }}"
                >
                    <a href="{{ route($routeResource . '.index') }}?orderby={{ $column->getId() }}&order={{ $column->getNewOrder() }}&page={{ $page }}">
                        {{ $column->getName() }}
                    </a>
                </th>
            @else
                <th class="border-top-0" width="60">&nbsp;</th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($entities as $entity)
        <tr>
            @foreach ($model::crudColumns() as $column)
                @if($column->getId() === \Rasrobin\Crud\Column::VIEW)
                    <td width="60">
                        <a href="{{ route($routeResource . '.show', $entity->id) }}" class="btn-link">view</a>
                    </td>
                @elseif($column->getId() === \Rasrobin\Crud\Column::EDIT)
                    <td width="60">
                        <a href="{{ route($routeResource . '.edit', $entity->id) }}" class="btn-link">edit</a>
                    </td>
                @elseif($column->getId() === \Rasrobin\Crud\Column::DELETE)
                    <td width="60">
                        {{ Form::open([
                            'method' => 'Delete',
                            'route' => [$routeResource . '.destroy', $entity->id]
                        ]) }}
                        <button type="submit" class="btn-link" style="border: 0">delete</button>
                        {{ Form::close() }}
                    </td>
                @else
                    <td>
                        {{ $column->processValue($entity->{$column->getId()}) }}
                    </td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
{{ $entities->appends(Request::only(['orderby', 'order']))->links() }}