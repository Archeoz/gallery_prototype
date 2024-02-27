@extends('admin.master')
@section('admincontent')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mailbox-messages">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                        class="far fa-square"> Check All</i>
                                </button>
                                <thead>
                                    <tr>
                                        <th>Check Box</th>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <form action="{{ url('editstatususeradmin') }}" method="post">
                                    @csrf
                                    @foreach ($user as $u)
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="{{ $u->id }}" name="id[]"
                                                            id="check{{ $u->id }}">
                                                        <label for="check{{ $u->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $u->id }}</td>
                                                <td>{{ $u->username }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td>
                                                    @if ($u->status == 'active')
                                                        <a class="btn btn-success btn-sm">Active</a>
                                                    @elseif($u->status == 'pending')
                                                        <a class="btn btn-secondary btn-sm">Pending</a>
                                                    @elseif($u->status == 'blocked')
                                                        <a class="btn btn-danger btn-sm">Blocked</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" style="text-align: right">
                                                <button type="submit" class="btn btn-success btn-sm" onclick="alert('teffwete')">Active</button>
                                                <button type="submit" name="active"
                                                    class="btn btn-secondary btn-sm">Pending</button>
                                                <button type="submit" name="active"
                                                    class="btn btn-danger btn-sm">Blocked</button>
                                            </th>
                                </form>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
