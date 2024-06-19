<table>
    <thead>
    <tr>
        <th>Краткое наименование груза</th>
        <th>Трэк Номер</th>
        <th>Штрих Код</th>
        <th>Склад</th>
        <th>Контайнер</th>
        <th>Дата Создание</th>
        <th>Вес</th>
        <th>Мест</th>
        <th>Обьем</th>
    </tr>
    </thead>
    <tbody>
        @php
            $sum_weight = 0;
            $sum_place = 0;
            $sum_capacity = 0;
        @endphp
    @foreach($cargos as $cargo)
        <tr>
            <td>{{ $cargo->title_ru }}</td>
            <td>№{{ $cargo->track_number }}</td>
            <td>{{ $cargo->barcode }}</td>
            <td>{{ $cargo->storage->name }}</td>
            <td>{{ $cargo->container ? $cargo->container->name : 'Не в контайнере' }}</td>
            <td>{{ $cargo->created_at }}</td>
            <td>{{ $cargo->weight }}кг</td>
            <td>{{ $cargo->place }}</td>
            <td>{{ $cargo->capacity }}&#179;</td>
        </tr>
        @php
            $sum_weight += floatval($cargo->weight);
            $sum_place += floatval($cargo->place);
            $sum_capacity += floatval($cargo->capacity);            
        @endphp
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Вес: {{ $sum_weight}}кг</th>
        <th>Мест: {{ $sum_place }}</th>
        <th>Обьем: {{$sum_capacity }}&#179;</th>
    </tr>
    </tfoot>
</table>