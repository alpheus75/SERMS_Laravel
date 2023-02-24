@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Registered Students</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">{{$students}}</span>
                      since {{$date}}
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Reported SOS</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">{{$all_sos}}</span>
                      since {{$date}}
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fa fa-medkit text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Confirmed Incidents</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder">{{$confirmed}}</span>
                      since {{$date}}
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-warning text-center rounded-circle">
                    <i class="fa fa-heart-o text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Resolved Incidents</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">{{$resolved}}</span>
                      since {{$date}}
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-success text-center rounded-circle">
                    <i class="fa fa-heartbeat text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
      <div class="row mt-4 container-fluid py-4">
        
          <div class="card z-index-2 h-100 bg-gradient-primary">
            <div class="card-header pb-0 pt-3 bg-gradient-primary">

              <h6 class="text-capitalize">Reported SOS</h6>
              
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="reported-sos" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>

        <div class="col-lg-5">
          
        </div>
      </div>
      <div class="row mt-4 container-fluid py-4">
        
          <div class="card z-index-2 h-100 bg-gradient-secondary">
            <div class="card-header pb-0 pt-3 bg-gradient-secondary">
              <h6 class="text-capitalize">Incidents overview</h6>
              
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="incidents" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>

        <div class="col-lg-5">
          
        </div>
      </div>
          
@endsection
@section('scripts')
<script >
    //sos chart values
    var labels =  {{ Js::from($labels) }};
    var sos =  {{ Js::from($sos) }};

    //incidents chart values
    var incident_labels =  {{ Js::from($incident_labels) }};
    var incident =  {{ Js::from($incident) }};
  </script>
@endsection