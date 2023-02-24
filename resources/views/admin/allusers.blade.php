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
                            
                            <button type="button" id="sos-id" data-bs-toggle="modal" data-bs-target="#admit-sos-modal" data-item-id="{{$student->reg_no}}">Update</button>
                            <button type="button"><a href="{{url('/dismisssos/'. $student -> reg_no)}}">Delete</a></button>

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
                            <button type="button" id="sos-id" data-bs-toggle="modal" data-bs-target="#admit-sos-modal" data-item-id="{{$staff->work_id}}">Update</button>
                            <button type="button"><a href="{{url('/dismisssos/'. $staff->work_id)}}">Delete</a></button>
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
    
    <!-- Modal HTML Markup for Admitting an SOS -->
      <div  class="modal fade" id="admit-sos-modal"  role="dialog" aria-labelledby="admit-sos-modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h1 class="modal-title">SOS Details</h1>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                      <form id="admit-sos-form" action="{{ route('admitsos') }}" method="post">
                       @csrf
                        <div class="pl-lg-6">
                          <div class="col-lg-5">
                            <div class="form-group">
                              <input name="sos_id" type="hidden" id="sos_id" class="form-control form-control-alternative">
                            </div>
                          </div> 
                          
                          <div class="col-lg-5">
                            <div class="form-group">
                              <label class="form-control-label">Description: </label>
                              <input name="description" type="text" id="description" class="form-control form-control-alternative" placeholder="briefly describe the situation" required>
                            </div>
                          </div>
                          <div class="col-lg-5">
                            <div class="form-group">
                              <fieldset>
                                Status:
                                <select name="status">
                                  <option value="Active">Active</option>
                                  <option value="Resolved">Resolved</option>
                                  <option value="Dismissed">Dismissed</option>
                                </select>
                              </fieldset>
                            </div>
                          </div>
                          <div class="col-lg-5">
                            @php
                             $personnel = $staffs->count();
                            @endphp
                            <div class="form-group">
                              <fieldset>
                                Assign Personnel:
                                <select name="personnel">
                                  
                                  @if($personnel > 0)
                                  <option value="" disabled selected hidden>Select Personnel</option>
                                  @foreach ($staffs as $staff)
                                  <option value="{{$staff->work_id}}">{{$staff->name}}</option>
                                  @endforeach
                                  @endif
                                  @if($personnel == 0)
                                  <option value="" disabled selected hidden>All Personnel are engaged at the moment!</option>
                                  @endif
                                </select>
                              </fieldset>
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