@extends('student.master')

@section('content')



  <div class="card z-index-2 h-100 container bg-secondary align-items-center">
    <div class="row">
      <p><h5>Hello <span>{{Auth::user()->name}}</span>, we are working round the clock to ensure your safety. Feel free to keep in touch by sending an SOS by clicking the emergency Icon below or capturing the incident image in the link above</h5></p>
    </div>
    <div>
      <a class="nav-item nav-link text-danger font-weight-bold" href="{{url('/student/sos')}}">
        <img src="../assets/img/sos-2.jpg" class="rounded-circle" style="height: 200px;">
        <span class="text-center">Send SOS</span>
      </a>
    </div>    
    <div class="row">
      <p><h5>Wer'e there for you</h5></p>
    </div> 
  </div>

<!--START MODAL-->
    
<!-- Modal HTML Markup for Student details -->
<div id="ModalLoginForm" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title">Student Details</h1>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form id="edit-student-data-form" method="post">
         {{ csrf_field() }}
         @method('post')
          <div class="pl-lg-6">
              
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="post-text">Name: </label>
                {{$name}}
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label">Reg No: </label>
                {{$sender}}
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label">Program: </label>
                {{$program}}
              </div>
            </div>
                
            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Email: </label>
                <input name="email" type="email" id="email" class="form-control form-control-alternative" placeholder="{{$email}}">
              </div>
            </div>

            <div class="col-lg-5">
              <div class="form-group">
                <label class="form-control-label" for="input-phone">Phone Number</label>
                <input name="phone" type="text" id ="phone" class="form-control form-control-alternative" placeholder="{{$tel}}">
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