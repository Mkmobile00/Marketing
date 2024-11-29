@extends('layouts.app')
@section('title', env('DEFAULT_TITLE') . ' | ' . 'Log Report')
@section('content')
    <section id="default-breadcrumb">
        <div class="row" id="table-bordered">
            <div class="col-4">
                <select class="form-select" aria-label="Default select example" id="selectFilter">
                    <option selected>Filter Options</option>
                    <option value="1">Yearly</option>
                    <option value="2">Monthly</option>
                    <option value="4">All</option>
                  </select>
            </div>
            <div class="col-12">
                <!-- list and filter start -->
                <div class="card">
                    
                    <div class="row me-2 ms-2">
                        <form action="#" id="filter-form" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="users" id="yearlabel">Year:</label>
                                        <select name="year" id="year" class="form-control form-control-sm" >
                                            <option value="">Please Select</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}" data-type="{{ $year }}" {{(@$filters['year'] == $year) ? 'selected' : ''}}>
                                                    {{ $year }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="users" id="monthlabel">Month:</label>
                                        <select name="month" id="month" class="form-control form-control-sm">
                                            <option value="">Please Select</option>
                                            @foreach ($months as $index => $month)
                                                <option value="{{ $month['value'] }}" data-type="{{ $month['value'] }}" {{(@$filters['month'] == $month['value']) ? 'selected' : ''}}>
                                                    {{ $month['title'] }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm mt-2" id="filter-btn" type="button">Filter</button>
                                    </div>
                                </div>
        
                            </div>
                        </form>
                    </div>
            
                    <div class="card mt">
                        <div class="card-body mid-body">
                    <div class="btn-bulk">
                        <a href="{{route('admin.sellersalesreportexcel')}}" class="global-btn pdfbilled" style="margin-left:5px;">Export
                            (CSV)</a>
                    </div>
                        </div>
                         </div>
                    <div class="card-body border-bottom">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="orde-list-table table data-table">
                                <thead class="table-light text-capitalize">
                                    <tr>
                                        <th>S.N</th> 
                                        <th>Log From</th>
                                        <th>Name</th>
                                        <th>Log Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    @include('admin.includes.datatables')
@endpush
@push('script')
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('log.index') }}",
            data:function(d){
                @foreach($filters as $index=>$filter)
                    d.{{ $index }} = "{{ $filter }}",
                @endforeach
                d.year =  $("#year").val(),
                d.month = $("#month").val(),
                d.area = $("#type").val()
            }
        },
        columns: [{
                data: "DT_RowIndex",
                render: (data, type) => `${data}`,
                searchable: false,
                orderable: false,
            },
                    {
                        data: "log_from"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "log_detail"
                    },
    
        ],
        columnDefs: [{
            className: "control",
            orderable: false,
            responsivePriority: 2,
            targets: 0,
            render: function(data, type, full, meta) {
                return "";
            },
        }, ],
        fnDrawCallback: function(oSettings) {
            feather.replace({
                width: 14,
                height: 14,
            });
        },
    });

    $(document).ready(function(){
            $('#filter-btn').on('click', function(e){
            table.draw();
                
                // table.clear().rows.add($('#year')).draw();
                // table.clear().rows.add($('#month')).draw();

                // });
            });
        });
</script>

<script>
    var y='';
        y+='<option value="">Please Select</option>';
    @foreach($years as $year)
    var year_value="{{$year}}"
        y+='<option value="'+year_value+'" data-type="'+year_value+'">';
        y+=year_value+'</option>';
    @endforeach

    var m='';
        m+='<option value="">Please Select</option>';
    @foreach ($months as $index => $month)
        var month_value="{{$month['value']}}";
        m+='<option value="'+month_value+'" data-type="'+month_value+'">';
        m+="{{$month['title']}}"+'</option>';
            
    @endforeach
    // alert(m);
</script>

<script>
    
    $('#selectFilter').change(function()
    {
        var value=$(this).val();
        if(parseInt(value)==1)
        {
            $('#year').removeAttr('disabled');
            $('#year').html(y);
            $('#month').empty();
            $('#month').attr('disabled',true);
        }else if(parseInt(value)==2)
        {
            $('#month').removeAttr('disabled');
            $('#month').html(m);
            $('#year').empty();
            $('#year').attr('disabled',true);
        }else if(parseInt(value)==4)
        {
            $('#month').removeAttr('disabled');
            $('#year').removeAttr('disabled');
            $('#month').html(m);
            $('#year').html(y);
        }
    });
</script>

@endpush



