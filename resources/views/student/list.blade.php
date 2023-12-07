@extends('layouts.main')

@section('content')
<div class="pagetitle">
    <br>
      <h2>Student List</h2>
       
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body p-3">
                <table class="table table-bordered" id="student-table" >
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Date of birth</th>
                            <th>Addres</th>
                            <th>QR CODE</th>    
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if(isset($list))
                        @foreach($list as $c)
                        <tr>
                            <td>{{ $c->StudentID }}</td>
                            <td>{{ $c->FirstName . ' '.$c->LastName  }}</td>
                            <td>{{ date('M. d, Y', strtotime($c->DateofBirth)) }}</td>
                            <td>{{ $c->Address }}</td>
                            <td>{!!  DNS2D::getBarcodeHTML(" $c->qrcodes", 'QRCODE')!!}</td>                       
                            <td>
                                <a href="{{ route('editStudent', [encrypt($c->id)]) }}" class="btn btn-success">Edit</a>
                                <a onclick="confirmDelete('{{ encrypt($c->id) }}')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                      @endif 
                    </tbody> 
                </table>
            </div> 
          </div>
        </div>
      
    </section>
 @endsection
 @section('scripts')
    <script>
      $(window). ready(function (){
         const table =  $("#student-table").DataTable({    
            "dom": '<"row align-items-center"<"col-md-6" l><"col-md-3" f><"col-md-3"B>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">',
            })
           
        })
      
      function confirmDelete(id){
        var formData = new FormData()
          formData.append('StudentID', id)
          Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
        type: "POST",
        url: "{{ route('x_removeStudentByID') }}",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false, 
        async: false,
        success: function(data){
          if (data.result == true){
              Swal.fire({
                  icon: data.icon,
                  title: data.title,
                  text: data.message
              })

              setTimeout( function(){
                location.reload() 
              }, 1000)
          
          }
        },
        error: function(data){
          message = 'We are unable to process request.';
          if (data.responseJSON !== undefined) {
              message = '';
              for (var i in data.responseJSON.errors){
                  var d = data.responseJSON.errors[i];
                  message += d + '<br>';
              }
          }
          Swal.fire({
            icon: 'error',
            title: 'Ooopss...',
            text: message
          })
        }
  });

} 
})

}


    </script>
   
 @endsection