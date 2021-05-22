<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
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
                if(Session::has('name')) echo Session::get('name');
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
          <li class="nav-item active">
            <a href="{{ url('roles') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('categories') }}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('users') }}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('posts') }}" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Posts
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
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" required>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                  </div>

                  <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                  </div>

                  <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role_id">
                      <option selected disabled>Please select the Role</option>
                      @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    {{-- <th>Phone</th> --}}
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        {{-- <td>{{ $user->phone->phone }}</td> --}}
                        <td>
                          <a class="editUser btn btn-info" 
                            data-id="{{ $user->id }}" 
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            data-role="{{ $user->role_id }}">Edit</a>
                          <a class="removeUser btn btn-danger" data-id="{{ $user->id }}">Remove</a>
                        </td>
                      </tr>
                    @endforeach
                  </tfoot>
                </table>
                <form>
                  <div class="modal fade show" id="editUserModal" aria-modal="true" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit User</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" class="form-control" id="editId" readonly required>
                          <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="editName" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="editEmail" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Role</label>
                                <select class="form-control" id="editRoleId">
                                    <option selected disabled>Please select the Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
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
                  <div class="modal fade show" id="removeUserModal" aria-modal="true" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Remove User</h4>
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
<!-- Page specific script -->
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>
  function csrfToken() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  }

  $(document).ready(function() {
    $('#btnSave').on('click', function(e) {
      e.preventDefault()
      const name = $('#name').val()
      const email = $('#email').val()
      const password = $('#password').val()
      const role = $('#role_id').val()
      csrfToken()

      try {
        if (typeof name !== 'string' || !name) {
          alert('Name should be non-empty string')
          return
        }

        if (typeof email !== 'string' || !email) {
          alert('Email should be non-empty string')
          return
        }

        if (typeof password !== 'string' || !password) {
          alert('Password should be non-empty string')
          return
        }

        if (typeof role !== 'string' || !role) {
          alert('Role should be non-empty string')
          return
        }

        $.ajax({
          url: '/users',
          type: 'POST',
          dataType: 'json',
          async: true,
          data: {
            name,
            email,
            password,
            role_id: role
          },
          error: function (err) {
            console.error(err)
            alert(err.message)
            return
          },
          success: function (response) {
            console.log(response)
            alert(response.message)
            location.href="users"
            return
          }
        })
      } catch (error) {
        console.error(error)
        alert(error.message)
        return
      }
    })

    $('.editUser').on('click', function() {
      const id = $(this).data('id')
      const name = $(this).data('name')
      const email = $(this).data('email')
      const role = $(this).data('role')

      $("#editName").val(name)
      $("#editId").val(id)
      $("#editEmail").val(email)
      $("#editRoleId").val(role)
      
      $("#editUserModal").modal('show')
    })

    $("#btnUpdate").on('click', function(e) {
      e.preventDefault()
      const name = $("#editName").val()
      const id = $("#editId").val()
      const email = $("#editEmail").val()
      const roleId = $("#editRoleId").val()
      csrfToken()

      try {
        if (typeof name !== 'string' || !name) {
          alert('Name should be non-empty string')
          return
        }

        if (typeof email !== 'string' || !email) {
          alert('Email should be non-empty string')
          return
        }

        if (typeof roleId !== 'string' || !roleId) {
          alert('Role Id should be non-empty string')
          return
        }

        if (typeof id !== 'string' || !id) {
          alert('Id name should be non-empty string')
          return
        }

        $.ajax({
          url: `/users/update/${id}`,
          type: 'PUT',
          dataType: 'json',
          async: true,
          data: {
              name,
              email,
              role_id: roleId
          },
          error: function (err) {
            console.error(err)
            alert(err.message)
            return
          },
          success: function (response) {
            console.log(response)
            alert(response.message)
            location.href="users"
            return
          }
        })
      } catch (error) {
        console.error(error)
        alert(error.message)
        return
      }
    })

    $(".removeUser").on('click', function() {
      const id = $(this).data('id')
      $("#removeId").val(id)
      $("#removeUserModal").modal('show')
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
          url: `/users/delete/${id}`,
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
            location.href="users"
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
