<?php
use App\Student;
$student = new Student();
$user_id = auth()->id()
?>

    <div class="row">
        <div class="col-sm-4 form-group">
            {!! Form::select('gender',['-1'=>'Select Gender','1'=>__('message.male'),'0'=>__('message.female'),'2'=>__('message.unknown')],session('gender'),['class'=>'form-control','onChange'=>'ajaxLoad("'.url("student").'?gender="+this.value)']) !!}
        </div>
        <div class="col-sm-5 form-group">
            <div class="input-group">
                <input class="form-control" id="search"
                       value="{{ session('search') }}"
                       onChange = "ajaxLoad('{{url('/student')}}?search='+this.value)"
                       placeholder="Search name" name="search"
                       type="text" id="search"/>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-warning"
                            onclick="ajaxLoad('{{url('/student')}}?search='+$('#search').val())">
                        {{__('message.search')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- customer area -->
<div class="panel panel-default">
    <div class="panel-heading">{{ __('message.user_list') }}</div>
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <th><a href="javascript:ajaxLoad('{{ url('student?field=id&sort='.(session('sort')=='asc'?'desc':'asc')) }}')">{{ __('message.id') }}</a></th>
            <th>{{ __('message.name') }}</th>
            <th><a href="javascript:ajaxLoad('{{ url('student?field=age&sort='.(session('sort')=='asc'?'desc':'asc'))}}')">{{ __('message.age') }}</a></th>
            <th><a href="javascript:ajaxLoad('{{ url('student?field=gender&sort='.(session('sort')=='asc'?'desc':'asc'))}}')">{{ __('message.gender') }}</a></th>
            <th>Task(FIN./NEW)</th>
            <th>{{ __('message.created_time') }}</th>
            <th>{{ __('message.operation') }}</th>
        </thead>
        <tbody id="sortable">
           @foreach($students as $student)
           <tr class="row1" data-id="{{ $student->id }}">
               <th scope="row">{{ $student->id }}</th>
               <td>{{ $student->name }}</td>
               <td>{{ $student->age }}</td>
               <td>{{ $student->gender($student->gender) }}</td>
               <td>
                @foreach($student->taskNumber() as $ind => $completed)
                  {{ $completed }}
                @endforeach
              </td>
               <td>{{ $student->created_at }}</td>
               <td>
                   <a href="{{ route('student.show', ['id' => $student->id]) }}">{{ __('message.view') }}</a>
                @can('update',$student)
                    | 
                   <a href="{{ route('student.edit', ['id' => $student->id]) }}">{{ __('message.edit')}}</a> | 
                   <a href="{{ route('student.destroy', ['id' => $student->id]) }}" data-method="delete" data-name="{{$student->name}}" data-id="{{ $student->id }}" class="removeItem">{{ __('message.delete')}}</a>
                @endcan
               </td>
           </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- pagination  -->
    <nav>
        <ul class="pagination justify-content-end">
            {{$students->links()}}
        </ul>
    </nav>

</div>
 <script type="text/javascript">


  $(function () {


    $( "#sortable" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }


    });


    $('.removeItem').click(function (event) {
      event.preventDefault(); // does not go through with the link.
      var $this = $(this);
      var url_id = $(this).attr('data-id'), name = $(this).attr('data-name');
      if(confirm('Are you sure you want to delete this?')) {
        $.ajax({
        type: "POST",
        url: $this.attr('href'),
        data: {"id": url_id , _method: 'delete' },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          $('.row1[data-id='+ url_id +']').slideUp();
          $('#alert-modal .modal-body').html('You Remove ' + name + ' from your list');
          $('#alert-modal').modal('toggle');     
        },
        error: function (data) {
          console.log('Error:', data);
          $('#alert-modal .modal-body').html('You are not allowed to remove the item.');
          $('#alert-modal').modal('toggle');     
        }
        });
      }        
    });


    function sendOrderToServer() {

      var order = [];
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });
      //if more than 1 page, position goes wrong;
      $.ajax({
        type: "PATCH", 
        dataType: "JSON", 
        url: "{{ route('student.index') }}",
        data: {
          field: 'order_p',
          order: order,
          _token: '{{csrf_token()}}'

        },
        success: function(response) {
            if (response.status == "success") {
              //console.log(response);
            } else {
              //console.log(response);
            }
        }
      });

    }
  });

</script>