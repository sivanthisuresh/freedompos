
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href=".">

                <strong style="color:yellow"> PCP CASH MANAGEMENT </strong>

            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-end " id="navigation">

            <ul class="navbar-nav  ">
                <li class="nav-item">

                    <a class="nav-link active" aria-current="page" href="dashboard">
                        <i class="fa fa-tachometer-alt"></i> Dashboard</a>
                </li>

                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-clipboard-list"></i>PRODUCTS
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="product">DETAILS</a>
                      <a class="dropdown-item" href="supplier">SUPPLIERS</a>
                    </div>
                </li>


                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" id="dropmenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-clipboard-list"></i>INMATES
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropmenu2">
                      <a class="dropdown-item" href="inmate">DETAILS</a>
                      <a class="dropdown-item" href="block">BLOCKS</a>
                      <a class="dropdown-item" href="account">ACCOUNTS</a>
                      <a class="dropdown-item" href="transaction">TRANSACTIONS</a>

                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="report">Reports</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="change">HISTORY</a>
                </li>

                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" id="userdrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userdrop">
                      <div class="dropdown-item">
                          Your Name Comes Here
                      </div>
                      <a class="dropdown-item" href="">SETTING</a>
                      <a class="dropdown-item" href="">LOGOUT</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
  </nav>
  <div class="shadow-sm p-3 mb-5 bg-white rounded center" style="margin-top: 60px;">
    <img src= "{{ asset('../resources/img/logo.png') }}"
        style="

            width:40px;
            height: 40px;
        "
        ><strong>TAMIL NADU PRISON DEPARTMENT - COIMBATORE </strong>

  </div>
