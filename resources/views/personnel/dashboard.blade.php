<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Personnel Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <!-- Datatables CSS file -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav class="navbar navbar-expand-lg shadow-none">
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link active text-white font-weight-bold" href="{{route('home.staff')}}">Home</a>
              <a class="nav-item nav-link text-white font-weight-bold" href="{{url('/map')}}">Map</a>
              <a class="nav-item nav-link text-white font-weight-bold" href="{{route('home.staff')}}#ipersonnel-incident-table">My Incidents</a>
              <a class="nav-item nav-link text-white font-weight-bold" href="#">Track Incident</a>
            </div>
          </div>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          @if (session('message'))
              <div id ="successMessage" class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif
          @php
              $notifications = Auth::user()->unreadNotifications;
          @endphp
          @if ($notifications->isNotEmpty())
            <div id="sos-div">
              <div id="sos-alert" class="alert alert-danger">
                
                <h5>You have a new Incident notification<a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                View
              </a></h5>
              </div>
            </div> 
          @endif
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                @php
                    $notifications = Auth::user()->unreadNotifications;

                    
                @endphp
                @foreach ($notifications as $notification)
                  <li class="mb-2">
                    <div class="d-flex py-1 alert-success">
                      <div id="sos-success" class="d-flex flex-column justify-content-center">
                        {{ $notification->data['message'] }}
                        @if ($notification->data['sosUrl'])
                            <p class="text-sm font-weight-normal mb-1">Latest SOS: <a href="{{ $notification->data['sosUrl'] }}">View</a></p>
                        @endif
                      </div>
                    </div>
                  </li> 
                @endforeach
                
                @php
                  foreach($notifications as $notification){
                     $notification->markAsRead();
                     Auth::user()->notifications()->delete();
                  }
                @endphp
                @if ($notifications->isEmpty())
                  <li class="mb-2">
                    <div class="d-flex py-1">
                      
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">No unread notification</span>
                        </h6>
                        
                      </div>
                    </div>
                  </li> 
                @endif
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row d-flex justify-content-around">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Assigned Incidents</p>
                    <h5 class="font-weight-bolder">
                      {{$assigned}}
                    </h5>
                    <p class="mb-0">
                       since
                      <span class="text-success text-sm font-weight-bolder">{{$date}}</span>
                     
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Resolved Incidents</p>
                    <h5 class="font-weight-bolder">
                      {{$resolved}}
                    </h5>
                    <p class="mb-0">
                      since
                      <span class="text-success text-sm font-weight-bolder">{{$date}}</span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fa fa-heartbeat text-lg opacity-10" aria-hidden="true"></i>
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">My Rating</p>
                    <h5 class="font-weight-bolder">
                      {{$rating}}%
                    </h5>
                    <p class="mb-0">
                      since
                      <span class="text-danger text-sm font-weight-bolder">{{$date}}</span>
                      
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="fa fa-star text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="mt-4 container-fluid py-4 justify-content-center h-100" style="width: 90%;">
        
          <div class="card z-index-2 h-100 bg-gradient-primary">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Active Incidents</h6>
              
            </div>
            <div class="card-body p-3 bg-primary">
              <table id="active-incident-table" class = "display" width="100%">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Sender</th>
                          <th scope="col">Description</th>
                          <th scope="col">Location</th>
                          <th scope="col">Status</th>
                          <th scope="col">AssignedTo</th>
                          <th scope="col">Remarks</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  @php
                    $count = $actives->count();
                  @endphp
                  <tbody>
                    @if($count > 0)
                      @foreach($actives as $incident)  
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>0{{$incident -> telephone}}</td>
                            <td>{{$incident -> description}}</td>
                            <td>{{$incident -> location}}</td>
                            <td>{{$incident -> status}}</td>
                            <td>{{$incident -> assigned_to}}</td>
                            <td>{{$incident -> remarks}}</td>
                            <td>{{$incident -> created_at}}</td>
                            <td>
                              <button type="button"><a href="{{url('/tracesos/'. $incident -> id)}}">Trace</a></button>
                              <button type="button" id="incident-id" data-bs-toggle="modal" data-bs-target="#update-incident-modal" data-item-id="{{$incident->id}}">Update</button>
                            </td>
                        </tr>
                      @endforeach
                    @endif
                    @if($count == 0)
                      <p class="text-capitalize text-white">
                        You have no active incidents
                      </p>
                    @endif
                  </tbody>
                  
              </table>
            </div>
          </div>
        </div>
        <div class="mt-4 container-fluid py-4 justify-content-center h-100" style="width: 90%;">
          <div class="card z-index-2 h-100 bg-gradient-secondary">
              <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">My Incidents</h6>
                
              </div>
              <div class="card-body p-3 bg-secondary">
                <table id="personnel-incident-table" class = "display" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Description</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">AssignedTo</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($incidents as $incident)  
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>0{{$incident -> telephone}}</td>
                            <td>{{$incident -> description}}</td>
                            <td>{{$incident -> location}}</td>
                            <td>{{$incident -> status}}</td>
                            <td>{{$incident -> assigned_to}}</td>
                            <td>{{$incident -> remarks}}</td>
                            <td>{{$incident -> created_at}}</td>
                            <td>
                              <button type="button"><a href="">View</a></button>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                    
                </table>
              </div>
            </div>
      </div>
    </div>
    <!--START MODAL-->
    
    <!-- Modal HTML Markup for Admitting an SOS -->
      <div  class="modal fade" id="update-incident-modal"  role="dialog" aria-labelledby="update-incident-modal" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h1 class="modal-title">SOS Details</h1>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                      <form id="update-incident-form" action="{{ route('updateincident') }}" method="post">
                       @csrf
                        <div class="pl-lg-6">
                          <div class="col-lg-5">
                            <div class="form-group">
                              <input name="incident_id" type="hidden" id="incident_id" class="form-control form-control-alternative">
                            </div>
                          </div> 
                          
                          <div class="col-lg-5">
                            <div class="form-group">
                              <label class="form-control-label">Remarks: </label>
                              <input name="remarks" type="text" id="remarks" class="form-control form-control-alternative" placeholder="briefly describe the situation" required>
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
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>
                <a href="#" class="font-weight-bold" target="_blank">@SERMS</a>
                for better emergency response.
              </div>
            </div>
            
          </div>
        </div>
      </footer>
    </div>
  </main>
  
    
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/myjs/chartscript.js"></script>
  <script src="../assets/js/myjs/tables.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>