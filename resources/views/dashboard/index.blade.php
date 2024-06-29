<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Temperature Monitoring</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <style>
      html {
        overflow-x: hidden;
      }
      body {
          height: 100vh;
      }

      .sidebar {
          width: 250px;
          transition: width 0.3s;
          display: block;
          overflow-y: auto;
          height: 100vh;
      }
      .sidebar.collapsed {
          width: 80px;
      }
      .sidebar .nav-link {
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
          transition: all 0.3s;
          padding: 0.75rem;
      }
      .sidebar.collapsed .nav-link {
          text-align: center;
          padding: 0.75rem;
      }
      /* .sidebar.collapsed .nav-link .menu-text {
          display: none;
      } */
      .sidebar .nav-link .icon {
          display: inline-block;
          width: 40px;
          text-align: center;
      }
      .content {
          flex-grow: 1;
          padding: 20px;
          overflow-y: auto;
      }

      .toggle-btn {
          margin: 1rem;
      }

      .company-name {
        margin-right: 5rem;
        font-size: 18pt;
        font-weight: 700;
      }

      .list-unstyled {
          padding-left: 0;
          list-style: none;
      }

      .card-alert p {
        font-size: 32pt;
        font-weight: bold;
      }

      @media (max-width: 1024px) {
          .sidebar {
              position: fixed;
              height: 100%;
              z-index: 1000;
              transform: translateX(-250px);

          }
          .sidebar.collapsed {
              transform: translateX(-70px);
              width: 250px;
          }

          .sidebar.collapsed .nav-link {
              text-align: center;
              padding: 0.75rem;
          }
          .sidebar.collapsed .nav-link .menu-text {
              display: inline;
          }
          .sidebar.visible {
              transform: translateX(0);
          }

          .signout-class {
            display: none;
          }

          .company-name {
              margin-left: 4rem;
          }
      }

      @media (min-width: 1024px) {
          .company-name {
              margin-right: 26rem;
          }
          .sidebar {
              position: fixed;
              height: 100%;
              z-index: 1000;
              transform: translateX(-250px);

          }
          .sidebar.collapsed {
              transform: translateX(-70px);
              width: 250px;
          }
      }
    </style>
  </head>
  <body>
    
      <header class="navbar navbar-dark row sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <div class="col-3 d-flex justify-content-between">
          <button class="btn btn-secondary toggle-btn" id="toggle-btn">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand my-auto px-4 company-name" href="#">Temperature Monitoring</a>
        </div>
        <div class="col-9">
          <div class="navbar-nav">
            <div class="nav-item text-nowrap signout-class">
              <a class="nav-link px-3 float-end fw-semibold" href="#">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                Sign out
              </a>
            </div>
          </div>
        </div>
      </header>

      <div class="container-fluid d-flex bg-light px-0">
        <div class="sidebar-container">
            <!-- Sidebar -->
            <div class="sidebar bg-light border-end d-flex flex-column" id="sidebar">
                <ul class="list-unstyled flex-column flex-shrink-0 mb-auto">
                    <li class="my-2">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-home"></i></span>
                            <span class="menu-text">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-user"></i></span>
                            <span class="menu-text">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-cog"></i></span>
                            <span class="menu-text">Settings</span>
                        </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link">
                          <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                          <span class="menu-text">Logout</span>
                      </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content">
          <main class="main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2 fw-semibold">{{ $day }}</h1>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2" hidden>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                  <span data-feather="calendar" class="align-text-bottom"></span>
                  This week
                </button>
              </div>
            </div>

            <div class="row card-alert px-3">
              <div class="col-sm my-1">
                <div class="card text-white"
                  @if ($lastData->t22 <= 40)
                      style="background-color: #007bff"
                  @else
                      style="background-color: #dc3545"
                  @endif
                >
                  <div class="card-body">
                    <h5 class="card-title">Temperature <span style="font-size: 10pt">( &ge; 40 )</span></h5>
                    <p class="card-text">{{ $lastData->t22 }} <span style="font-size: 18pt">&deg;C</span></p>
                  </div>
                </div>
              </div>

              <div class="col-sm my-1">
                <div class="card text-white"
                  @if ($lastData->h22 >= 30 && $lastData->h22 <= 50)
                      style="background-color: #6c757d"
                  @else
                      style="background-color: #17a2b8"
                  @endif
                >
                  <div class="card-body">
                    <h5 class="card-title">Humadity <span style="font-size: 10pt">( 30 &le; % &ge; 50 )</span></h5>
                    <p class="card-text">{{ $lastData->h22 }} <span style="font-size: 18pt">%</span></p>
                  </div>
                </div>
              </div>

              <div class="col-sm my-1">
                <div class="card text-white"
                  @if ($lastData->ppm <= 80)
                      style="background-color: #28a745"
                  @else
                      style="background-color: #fd7e14"
                  @endif
                >
                  <div class="card-body">
                    <h5 class="card-title">Substance Concentration <span style="font-size: 10pt">( &ge; 80 ppm )</span></h5>
                    <p class="card-text">{{ $lastData->ppm }} <span style="font-size: 18pt">PPM</span></p>
                  </div>
                </div>
              </div>
            </div>

            <div id="myChart" class="my-3"></div>

            <h2 class="mt-2">Section title</h2>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>1,002</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>data</td>
                    <td>rich</td>
                    <td>dashboard</td>
                    <td>tabular</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>information</td>
                    <td>placeholder</td>
                    <td>illustrative</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,004</td>
                    <td>text</td>
                    <td>random</td>
                    <td>layout</td>
                    <td>dashboard</td>
                  </tr>
                  <tr>
                    <td>1,005</td>
                    <td>dashboard</td>
                    <td>irrelevant</td>
                    <td>text</td>
                    <td>placeholder</td>
                  </tr>
                  <tr>
                    <td>1,006</td>
                    <td>dashboard</td>
                    <td>illustrative</td>
                    <td>rich</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,007</td>
                    <td>placeholder</td>
                    <td>tabular</td>
                    <td>information</td>
                    <td>irrelevant</td>
                  </tr>
                  <tr>
                    <td>1,008</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                  </tr>
                  <tr>
                    <td>1,009</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                  </tr>
                  <tr>
                    <td>1,010</td>
                    <td>data</td>
                    <td>rich</td>
                    <td>dashboard</td>
                    <td>tabular</td>
                  </tr>
                  <tr>
                    <td>1,011</td>
                    <td>information</td>
                    <td>placeholder</td>
                    <td>illustrative</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,012</td>
                    <td>text</td>
                    <td>placeholder</td>
                    <td>layout</td>
                    <td>dashboard</td>
                  </tr>
                  <tr>
                    <td>1,013</td>
                    <td>dashboard</td>
                    <td>irrelevant</td>
                    <td>text</td>
                    <td>visual</td>
                  </tr>
                  <tr>
                    <td>1,014</td>
                    <td>dashboard</td>
                    <td>illustrative</td>
                    <td>rich</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>1,015</td>
                    <td>random</td>
                    <td>tabular</td>
                    <td>information</td>
                    <td>text</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </main>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script> --}}
    <script>
      var dataArray = {!! json_encode($arrayData) !!};
      var day = '{{ $day }}';

      $(document).ready(function() {
          $('#toggle-btn').click(function() {
              $('#sidebar').toggleClass('collapsed');
          });
      });
    </script>
    <script src="\js\dashboard.js"></script>
  </body>
</html>
