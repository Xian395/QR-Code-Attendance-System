@extends('layouts.main')
@section('content')

<div class="pagetitle">
    <br>
      <h1>Attendance</h1>
      <br>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="form-group mb-2">
                           
                            <div class="input-group mb-3">
                                <input id="StudentID" disabled type="text" class="form-control shadow-none rounded-0"
                                    name="StudentID" value="" required
                                    autocomplete="StudentID" placeholder="Student Number scan">
                            </div>
                        </div>
                        <div class="form-group mb-2 p-0">
                            <video id="scanner" class="form-control p-0"></video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 bg-transparent mb-2 fs-2 text-primary lead">
                        <div class="d-flex justify-content-between text-success">
                            Student
                        </div>
                    </div>
                    <center>
                    <table>
                        <tr>
                    <th><button onclick="startScanner()" class="btn btn-success">Start Scanner</button></th>
                     <th><button onclick="stopScanner()" class="btn btn-success">Stop Scanner</button></th>
</tr>
                    </table>
                    <div class="card-body">
                        <div class="col-md-12 table-responsive" id="student-table">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="row">STUDENTS</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td id="studentList"></td>
                                        </tr>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        let scanner;
        let studentList = document.getElementById('studentList');

        function startScanner() {
            // Initialize the scanner
            scanner = new Instascan.Scanner({ video: document.getElementById('scanner') });

            // Listen for scan events
            scanner.addListener('scan', function (content) {
                // Extract the student name from the scanned content
                let studentName = content.trim(); // Assuming the QR code only contains the student name

                // Display or add the student name to the list
                displayStudentName(studentName);
            });

            // Start the scanner
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });
        }

        function stopScanner() {
            if (scanner) {
                scanner.stop();
                
            }
        }

        function displayStudentName(studentName) {
            // Create a new list item and append it to the student list
            let listItem = document.createElement('li');
            listItem.textContent = studentName;
            studentList.appendChild(listItem);
        }
    </script>
@endsection
