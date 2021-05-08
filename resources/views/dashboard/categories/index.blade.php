<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Categories</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" href="{{ url('signin/auth/signout') }}" role="button">
            <i class="fas fa-sign-out-alt"></i>
          Sign Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">
              @php
                  if(Session::has('name')) Session::get('name');
                  else echo "Unknown";
              @endphp
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('roles') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
          <li class="nav-item active">
            <a href="{{ url('categories') }}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Category Name" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $item)
                      <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                          <a class="editCategory btn btn-info" data-id="{{ $item->id }}" data-name="{{ $item->name }}">Edit</a>
                          <a class="removeCategory btn btn-danger" data-id="{{ $item->id }}">Remove</a>
                        </td>
                      </tr>
                    @endforeach
                  </tfoot>
                </table>
                <form>
                  <div class="modal fade show" id="editCategoryModal" aria-modal="true" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Category</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" class="form-control" id="editId" readonly required>
                          <div class="card-body">
                            <div class="form-group">
                              <label for="name">Category Name</label>
                              <input type="text" class="form-control" id="editName" placeholder="Category Name" required>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" id="btnUpdate">Save changes</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </form>

                <form action="">
                  <div class="modal fade show" id="removeCategoryModal" aria-modal="true" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Remove Category</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" class="form-control" id="removeId" readonly required>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger" id="btnRemove">Yes, remove</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets') }}/dist/js/demo.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    bsCustomFileInput.init();
  });

  function csrfToken() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  }

  $(document).ready(function() {
    $('#btnSave').on('click', function(e) {
      e.preventDefault() // Mencegah formnya ke refresh
      const name = $('#name').val() // Mengambil value dari field role name
      csrfToken() // Memanggil token Laravel
      console.log(name);
      try {
        if (typeof name !== 'string' || !name) {
          alert('Category should be non-empty string')
          return
        }

        $.ajax({
          url: "/categories",
          type: 'POST',
          dataType: 'json',
          async: true,
          data: {name},
          error: function (err) {
            console.error(err)
            alert(err.message)
            return
          },
          success: function (response) {
            console.log(response)
            alert(response.message)
            location.href="categories"
            return
          }
        })
      } catch (error) {
        console.error(error)
        alert(error.message)
        return
      }
    })

    $('.editCategory').on('click', function() {
      const id = $(this).data('id')
      const name = $(this).data('name')

      $("#editName").val(name)
      $("#editId").val(id)
      $("#editCategoryModal").modal('show')
    })

    $("#btnUpdate").on('click', function(e) {
      e.preventDefault()
      const name = $("#editName").val()
      const id = $("#editId").val()
      csrfToken()

      try {
        if (typeof name !== 'string' || !name) {
          alert('Category name should be non-empty string')
          return
        }

        if (typeof id !== 'string' || !id) {
          alert('Id should be non-empty string')
          return
        }

        $.ajax({
          url: `/categories/update/${id}`,
          type: 'PUT',
          dataType: 'json',
          async: true,
          data: {name},
          error: function (err) {
            console.error(err)
            alert(err.message)
            return
          },
          success: function (response) {
            console.log(response)
            alert(response.message)
            location.href="categories"
            return
          }
        })
      } catch (error) {
        console.error(error)
        alert(error.message)
        return
      }
    })

    $(".removeCategory").on('click', function() {
      const id = $(this).data('id')
      $("#removeId").val(id)
      $("#removeCategoryModal").modal('show')
    })

    $("#btnRemove").on('click', function(e) {
      e.preventDefault()
      const id = $("#removeId").val()
      csrfToken()

      try {
        if (typeof id !== 'string' || !id) {
          alert('Id should be non-empty string')
          return
        }

        $.ajax({
          url: `/categories/delete/${id}`,
          type: 'DELETE',
          dataType: 'json',
          async: true,
          error: function (err) {
            console.error(err)
            alert(err.message)
            return
          },
          success: function (response) {
            console.log(response)
            alert(response.message)
            location.href="categories"
            return
          }
        })
      } catch (error) {
        console.error(error)
        alert(error.message)
        return
      }
    })
  })
</script>
</body>
</html>
