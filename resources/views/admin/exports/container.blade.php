@foreach($containers as $container)
    <table>
        <thead>
        <tr>
            <th>Контейнер</th>
            <th>Дата отправки</th>
            <th>Примечание</th>
            <th>Примечание türkmençe</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $container->name }}</td>
                <td>{{ $container->departure_date ?: 'Пустой' }}</td>
                <td>{{ $container->comment_ru ?: 'Пустой' }}</td>
                <td>{{ $container->comment_tk ?: 'Пустой' }}</td>
            </tr>
        @if(isset($container->cargos))
            @php
                $sum['weight'] = [];
                $sum['place'] = [];
                $sum['capacity'] = [];

                $array = [];
                    foreach ($container->cargos as $cargo) { 
                      $obj = (object) [
                        'title_ru' => $cargo->title_ru,
                        'title_tk' => $cargo->title_tk,
                        'truck_number' => $cargo->track_number,
                        'barcode' => $cargo->barcode,
                        'weight' => floatval($cargo->weight),
                        'place' => floatval($cargo->place),
                        'capacity' => floatval($cargo->capacity)
                    ];
                      array_push($sum['weight'], floatval($cargo->weight));
                      array_push($sum['place'], floatval($cargo->place));
                      array_push($sum['capacity'], floatval($cargo->capacity));
                      array_push($array, $obj);
                    }
                    $sum['place'] = array_sum($sum['place']);
                    $sum['capacity'] = array_sum($sum['capacity']);
                    $sum['weight'] = array_sum($sum['weight']);

                    $lastObj = (object) [
                      'cargos' => $array,
                      'sum_place' => $sum['place'],
                      'sum_capacity' => $sum['capacity'],
                      'sum_weight' => $sum['weight']
                  ];    
                    $array = $lastObj->cargos;
            @endphp
        @endif
    </tbody>
</table>
@if (!empty($array))
<table>
    <thead>
        <tr>
            <th>Краткое наименование груза</th>
            <th>Türkmençe</th>
            <th>Трек № груза</th>
            <th>Штрих Код</th>
            <th>Вес(кг)</th>
            <th>Мест</th>
            <th>Объем (куб)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $array as $item )
            <tr>
                <td>{{ $item->title_ru }}</td>
                <td>{{ $item->title_tk }}</td>
                <td>{{ $item->truck_number }}</td>
                <td>{{ $item->barcode }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->place }}</td>
                <td>{{ $item->capacity }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ $lastObj->sum_weight }}кг</th>
            <th>{{ $lastObj->sum_place }}</th>
            <th>{{ $lastObj->sum_capacity }}&#179;</th>
        </tr>
    </tfoot>
</table>
@else
<table>
    <thead>
        <tr>
            <th>Краткое наименование груза</th>
            <th>Türkmençe</th>
            <th>Трек № груза</th>
            <th>Штрих Код</th>
            <th>Вес</th>
            <th>Мест</th>
            <th>Объем (куб)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Пустой</th>
            <th>Пустой</th>
            <th>Пустой</th>
            <th>Пустой</th>
            <th>Пустой</th>
            <th>Пустой</th>
            <th>Пустой</th>
        </tr>
    </tbody>
</table>
@endif
@endforeach
    