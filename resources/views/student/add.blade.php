@extends('layouts.main')

@section('content')
<div class="pagetitle">
    <br>
      <h2>Add Student</h2>  
  </div>

  @if(isset($studentInfo))
  <div class="pagetitle">
      <h1>Student ID: {{ $StudentID }}</h1>
      <div class="row">
          <div class="col-md-4">
              <b>{{ $studentInfo->FirstName. ' ' . $studentInfo->MiddleName. ' ' .$studentInfo->FirstName.' '. $studentInfo->LastName }}</b>
          </div>
      </div> 
  </div>
  @endif
    <section class="section">
      <div class="row">
        <div class="col-md-12">

          <div class="card">
            <div class="card-body" >
                @livewire('student.add-student', ['StudentID' => $studentInfo->id ?? 0])
            </div>
          </div>
        </div>
</div>
        
        

       
    </section>
    @endsection