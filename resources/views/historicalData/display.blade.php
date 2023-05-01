@extends('layouts.layout')
@section('content')
{{-- {{ print_r($date) }} --}}
<h1 class="container">Historical Data Form - <a class="line" href="{{ route('historicaldata') }}">Home Page</a></h1>
<div class="container-table mt-10">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="th-sm">Date
            </th>
            <th class="th-sm">Open
            </th>
            <th class="th-sm">High
            </th>
            <th class="th-sm">Low
            </th>
            <th class="th-sm">Close
            </th>
            <th class="th-sm">Volume
            </th>
        </tr>
        </thead>
        <tbody>
            @php
                //collecting data for graph
                //d => date, o => open price, c => close price
                $d = $o = $c = [];
            @endphp

            @foreach($data as $val)

                @if($date['start_date'] <= $val['date'] && $date['end_date'] >= $val['date'] )
                    @php
                      $d[] = date("Y-M-d", $val['date']);
                      $o[] = isset($val['open']) ? $val['open'] : 0;
                      $c[] = isset($val['close']) ? $val['close'] : 0;
                    @endphp
                    <tr>
                        <td>{{ isset($val['date']) ? $val['date'] : "" }}</td>
                        <td>{{ isset($val['open']) ? $val['open'] : "" }}</td>
                        <td>{{ isset($val['high']) ? $val['high'] : "" }}</td>
                        <td>{{ isset($val['low']) ? $val['low'] : "" }}</td>
                        <td>{{ isset($val['close']) ? $val['close'] : "" }}</td>
                        <td>{{ isset($val['volume']) ? $val['volume'] : "" }}</td>
                    </tr>
                @endif
            @endforeach

        </tbody>

    </table>
    <canvas id="myChart" style="width:100%;"></canvas>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>

<script>
    var xValues =  {!! json_encode($d) !!};
    var openPrice = {!! json_encode($o) !!};
    var closePrice = {!! json_encode($c) !!};

    new Chart("myChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [
            {
          label: "open price",
          backgroundColor: "white",
          borderWidth: 1,
          borderColor: "#900",
          fill: false,
          data: openPrice
        },
        {
        label: "close price",
        backgroundColor: "white",
        borderWidth: 1,
        borderColor: "#090",
        fill: false,
        data: closePrice
      }
    ]
      },
      options: {
        maintainAspectRatio: true,
        scales: {
        yAxes: [{stacked: true}],
        xAxes: [{stacked: false}]
        }
      }
    });
    </script>

@endsection
