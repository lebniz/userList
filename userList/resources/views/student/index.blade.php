<?php
use App\Models\Student;
$student = new Student();
?>

    <div class="row">
        <div class="col-sm-4 form-group">
            {!! Form::select('gender',['-1'=>'Select Gender','1'=>'Male','0'=>'Female','2'=>'Unknown'],session('gender'),['class'=>'form-control','onChange'=>'ajaxLoad("'.url("student").'?gender="+this.value)']) !!}
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
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- customer area -->
<div class="panel panel-default">
    <div class="panel-heading">Student</div>
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <th><a href="javascript:ajaxLoad('{{ url('student?field=id&sort='.(session('sort')=='asc'?'desc':'asc')) }}')">ID</a></th>
            <th>Name</th>
            <th><a href="javascript:ajaxLoad('{{ url('student?field=age&sort='.(session('sort')=='asc'?'desc':'asc'))}}')">Age</a></th>
            <th><a href="javascript:ajaxLoad('{{ url('student?field=gender&sort='.(session('sort')=='asc'?'desc':'asc'))}}')">Gender</a></th>
            <th>Time</th>
            <th>operation</th>
        </thead>
        <tbody id="sortable">
           @foreach($students as $student)
           <tr class="row1" data-id="{{ $student->id }}">
               <th scope="row">{{ $student->id }}</th>
               <td>{{ $student->name }}</td>
               <td>{{ $student->age }}</td>
               <td>{{ $student->gender($student->gender) }}</td>
               <td>{{ date('Y-m-d', $student->created_time) }}</td>
               <td>
                   <a href="{{ url('student/show', ['id' => $student->id]) }}">view</a> | 
                   <a href="{{ url('student/update', ['id' => $student->id]) }}">edit</a> | 
                   <a onclick="if(confirm('DELETE {{ $student->name }} from student list') == false) return false;" href="{{ url('student/delete', ['id' => $student->id]) }}">delete</a>
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
        type: "POST", 
        dataType: "JSON", 
        url: "{{ url('student') }}",
        data: {
          field: 'order_p',
          order:order,
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