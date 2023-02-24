@extends('student.master')

@section('content')


<div class="card z-index-2 h-100 bg-gradient-primary">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">My Incidents</h6>
              
            </div>
            <div class="card-body p-3 bg-primary">
              <table id="my-incidents-table" class = "display" width="100%">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Sender</th>
                          <th scope="col">Description</th>
                          <th scope="col">Location</th>
                          <th scope="col">Status</th>
                          <th scope="col">Remarks</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  @php
                    $count = $incidents->count();
                  @endphp
                  <tbody>
                    @if($count > 0)
                      @foreach($incidents as $incident)  
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$incident -> sender}}</td>
                            <td>{{$incident -> description}}</td>
                            <td>{{$incident -> location}}</td>
                            <td>{{$incident -> status}}</td>
                            <td>{{$incident -> remarks}}</td>
                            <td>{{$incident -> created_at}}</td>
                            <td>
                              
                              <button type="button" id="rate-incident-id" data-bs-toggle="modal" data-bs-target="#rate-incident-modal" data-item-id="{{$incident->id}}">Rate</button>
                            </td>
                        </tr>
                      @endforeach
                    @endif
                    @if($count == 0)
                      <p class="text-capitalize text-white">
                        You have no recorded incidents
                      </p>
                    @endif
                  </tbody>
                  
              </table>
            </div>
          </div>
<!--START MODAL-->
    
<!-- Modal HTML Markup for Student details -->
<div  class="modal fade" id="rate-incident-modal"  role="dialog" aria-labelledby="rate-incident-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title">Rate Incident</h1>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form id="rate-incident-form"  action="{{ route('rate.incident') }}" method="post">
         {{ csrf_field() }}
         @method('post')
          <div class="pl-lg-6">
            <div class="col-lg-5">
              <div class="form-group">
                <input name="incident_id" type="hidden" id="incident_id" class="form-control form-control-alternative">
              </div>
            </div> 
            
            <div class="col-lg-12">
              <div class="form-group">
                <fieldset>
                  How would you rate how the incident was handled:
                  
                  <select name="incident_rate">
                    <option value="1">Very poor</option>
                    <option value="2">Poor</option>
                    <option value="3">Satisfactory</option>
                    <option value="4">Very Satisfactory</option>
                    <option value="5">Most Satisfactory</option>
                  </select>
                </fieldset>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <fieldset>
                  How would you describe how the staff responded to the incident:
                  
                  <select name="staff_rate">
                    <option value="1">Worse</option>
                    <option value="2">Bad</option>
                    <option value="3">Good</option>
                    <option value="4">Better</option>
                    <option value="5">Best</option>
                  </select>
                </fieldset>
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