@extends('layouts.layout')
@section('content')
    <div class="container mt-5">

        <h1>Historical Data Form</h1>
        <!-- Success message -->
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif
        <form  method="post" id="historical_form" action="{{ route('gethistoricaldata') }}">
            <!-- CROSS Site Request Forgery Protection -->
            @csrf
            <div class="form-group">
                <label>Company Symbol</label>
                <select class="form-control {{ $errors->has('symbol') ? 'error' : '' }}" name="symbol" id="symbol">
                    <option value="">Select Symbol</option>
                    @foreach ($data as $val)
                        @php
                            $arr[$val['Symbol']] = $val['Company Name'];
                        @endphp
                        <option {{ old('symbol') == $val['Symbol'] ? "selected" : "" }} >{{ $val['Symbol'] }}</option>
                    @endforeach
                </select>
                @if ($errors->has('symbol'))
                <div class="error">
                    {{ $errors->first('symbol') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="text" value="{{ old('start_date') }}" class="form-control datepicker {{ $errors->has('start_date') ? 'error' : '' }}" name="start_date" id="start_date" autocomplete="off">
                @if ($errors->has('start_date'))
                <div class="error">
                    {{ $errors->first('start_date') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="text" value="{{ old('end_date') }}" class="form-control datepicker {{ $errors->has('end_date') ? 'error' : '' }}" name="end_date" id="end_date" autocomplete="off">
                @if ($errors->has('end_date'))
                <div class="error">
                    {{ $errors->first('end_date') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email">
                @if ($errors->has('email'))
                <div class="error">
                    {{ $errors->first('email') }}
                </div>
                @endif
            </div>

            <input type="hidden" value="" name="company_name" id="company_name" />
            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>

    <script type="text/javascript">
        $( function() {
            $( ".datepicker" ).datepicker({
                maxDate: 0,
                dateFormat: 'yy-mm-dd'});
        });

        const arr = {!! json_encode($arr) !!};

        //client side custom validations
        const validator = new JustValidate('#historical_form');
        let d = new Date()
        d.setDate(d.getDate() + 1);

        validator.addField('#email', [
            {rule: 'required' },
            {rule: 'email',},
        ])
        .addField('#symbol',[
            {rule: 'required'},
        ])
        .addField('#start_date',[
            {rule: 'required'},
            {
                plugin: JustValidatePluginDate((fields) => ({
                    format: 'yyyy-MM-dd',
                })),
                errorMessage: 'Date should be in yyyy-MM-dd format.',
            },
            {
                plugin: JustValidatePluginDate((fields) => ({
                    isBeforeOrEqual: fields['#end_date'].elem.value,
                })),
                errorMessage: 'Date should before or equals to the end date',
            },
            {
                plugin: JustValidatePluginDate((fields) => ({
                    isBefore: d,
                })),
                errorMessage: 'Date should before or equals to the current date',
            },
        ])
        .addField('#end_date',[
            {rule: 'required'},
            {
                plugin: JustValidatePluginDate((fields) => ({
                    format: 'yyyy-MM-dd',
                })),
                errorMessage: 'Date should be in yyyy-MM-dd format.',
            },
            {
                plugin: JustValidatePluginDate((fields) => ({
                    isAfterOrEqual: fields['#start_date'].elem.value,
                })),
                errorMessage: 'Date should after or equals to the start date',
            },
            {
                plugin: JustValidatePluginDate((fields) => ({
                    isBefore: d,
                })),
                errorMessage: 'Date should before or equals to the current date',
            },
        ])
        .onSuccess((event) => {
            let sym = $("#symbol").val();
            $("#company_name").val(arr[sym]);
            document.getElementById("historical_form").submit();
        });
    </script>
@endsection
