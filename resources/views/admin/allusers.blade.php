@extends('admin.master')

@section('content')
    
      <div class="row mt-4 container-fluid py-4">
        
          <div class="card z-index-2 h-100 bg-gradient-primary">
            <div class="card-header pb-0 pt-3 bg-transparent">

              <h6 class="text-capitalize">Reported SOS</h6>
              
            </div>
            <div class="card-body p-3 bg-primary">
              <table id="students-table" class = "display" width="100%">
                  <thead class="thead-dark">
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Reg No.</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Telephone</th>
                          <th scope="col">Program</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($students as $student)  
                      <tr class="data-row">
                          <td>{{$loop->iteration}}</td>
                          <td>{{$student -> reg_no}}</td>
                          <td>{{$student -> name}}</td>
                          <td>{{$student -> email}}</td>
                          <td>{{$student -> telephone}}</td>
                          <td>{{$student -> program}}</td>
                          <td>
                            
                            <button type="button" id="reg-no" data-bs-toggle="modal" data-bs-target="#update-student-modal" data-item-id="{{$student->reg_no}}" data-item-name="{{$student->name}}" data-item-email="{{$student->email}}" data-item-tel="0{{$student->telephone}}">Update</button>
                            <button type="button"><a href="{{url('/getuser/'. $student -> reg_no)}}">Delete</a></button>

                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                  
              </table>
            </div>
          </div>

      </div>
      <div class="row mt-4 container-fluid py-4">
        
          <div class="card z-index-2 h-100 bg-gradient-primary">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Incidents overview</h6>
              
            </div>
            <div class="card-body p-3 bg-secondary">
              <table id="staffs-table" class = "display" width="100%">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Work Id</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Telephone</th>
                          <th scope="col">Rating</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($staffs as $staff)  
                      <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$staff -> work_id}}</td>
                          <td>{{$staff -> name}}</td>
                          <td>{{$staff -> email}}</td>
                          <td>{{$staff -> telephone}}</td>
                          
                            @if($staff -> rating == 0)
                              <td>Not Rated</td>
                            @endif
                            @if($staff -> rating > 0)
                              @php
                                $rate = $staff -> rating / 5 * 100;
                              @endphp
                              <td>{{$rate}}</td>
                            @endif
                          <td>
                            <button type="button" id="work-id" data-bs-toggle="modal" data-bs-target="#update-personnel-modal" data-item-id="{{$staff->work_id}}" data-item-name="{{$staff->name}}" data-item-email="{{$staff->email}}" data-item-tel="0{{$staff->telephone}}">
                              Update
                            </button>
                            <button type="button">
                              <a href="{{url('/getuser/'. $staff->work_id)}}">Delete</a>
                            </button>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                  
              </table>
            </div>
          </div>

        <div class="col-lg-5">
          
        </div>
      </div>
  <!--START MODAL-->
    
    <!-- Modal HTML Markup for editing and updating student details -->
      <div  class="modal fade" id="update-student-modal"  role="dialog" aria-labelledby="update-student-modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h1 class="modal-title">Student Details</h1>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                      <form id="update-student-form" action="{{ route('updatestudent') }}" method="post">
                       @csrf
                        <div class="pl-lg-12">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label class="form-control-label"><h4>Current Student Details</h4> </label>
                              <input name="reg_no" type="hidden" id="reg_no" class="form-control form-control-alternative">
                            </div>
                          </div> 
                          
                          <div class="col-lg-5">
                            <div class="form-group">
                              <label class="form-control-label">Name: </label>
                              <input name="name" type="text" id="name" class="form-control form-control-alternative"   required>
                            </div>
                          </div>
                          <div class="col-lg-5">
                            <div class="form-group">
                              <label class="form-control-label">Email: </label>
                              <input name="email" type="email" id="email" class="form-control form-control-alternative"  required>
                            </div>
                          </div>
                          <div class="col-lg-5">
                            <div class="form-group">
                              <label class="form-control-label">Telephone: </label>
                              <input name="telephone" type="text" id="telephone" class="form-control form-control-alternative" required>
                            </div>
                          </div>
                           
                        </div>
                      <!-- Submit button -->
                        <div id="results"></div>

                        <div class="pl-lg-0 pr-0 text-center">
                          <button class="btn btn-success btn-sm pl-lg-2 pt-2 pb-2 pr-2"
                            id="submit" style="color:white">
                            Submit
                          </button>
                          <img style="visibility: hidden" id="loader" src="{{ asset('argon') }}/img/brand/ajax-loader.gif" alt="working.." />
                        </div>
                      </form>
                      <div style="visibility: hidden" id="error">&nbsp;</div>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    
    <!--END MODAL-->

    <!--START MODAL-->
    
    <!-- Modal HTML Markup for editing and updating personnel details -->
      <div  class="modal fade" id="update-personnel-modal"  role="dialog" aria-labelledby="update-personnel-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                <h1 class="modal-title">Personnel Details</h1>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">

                  <form id="update-personnel-form" action="{{ route('updatestaff') }}" method="post">
                   @csrf
                    <div class="pl-lg-12">
                      <div class="col-lg-8">
                        <div class="form-group">
                          <label class="form-control-label"><h4>Current Personnel Details</h4> </label>
                          <input name="work_id" type="text" id="work_id" class="form-control form-control-alternative">
                        </div>
                      </div> 
                      
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label class="form-control-label">Name: </label>
                          <input name="name_p" type="text" id="name_p" class="form-control form-control-alternative"   required>
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label class="form-control-label">Email: </label>
                          <input name="email_p" type="email" id="email_p" class="form-control form-control-alternative"  required>
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <label class="form-control-label">Telephone: </label>
                          <input name="telephone_p" type="text" id="telephone_p" class="form-control form-control-alternative" required>
                        </div>
                      </div>
                       
                    </div>
                  <!-- Submit button -->
                    <div id="results"></div>

                    <div class="pl-lg-0 pr-0 text-center">
                      <button class="btn btn-success btn-sm pl-lg-2 pt-2 pb-2 pr-2"
                        id="submit" style="color:white">
                        Submit
                      </button>
                      <img style="visibility: hidden" id="loader" src="{{ asset('argon') }}/img/brand/ajax-loader.gif" alt="working.." />
                    </div>
                  </form>
                  <div style="visibility: hidden" id="error">&nbsp;</div>
              </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    
    <!--END MODAL-->
          
@endsection
@section('scripts')

@endsection