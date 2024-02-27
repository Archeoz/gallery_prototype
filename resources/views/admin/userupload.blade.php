@extends('admin.master')
@section('admincontent')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>Username</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Change Status</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($upload as $upl)
                                    <tbody>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $upl->id_user }}</td>
                                            <td>{{ $upl->username }}</td>
                                            <td>{{ $upl->judul }}</td>
                                            <td>{{ $upl->deskripsi }}</td>
                                            <td>
                                                <a href="{{ asset('foto/' . $upl->foto) }} " data-toggle="lightbox" data-title= "{{ $upl->judul }}" data-gallery="gallery">
                                                    <img src="{{ asset('foto/' . $upl->foto) }}" width="150" height="100" alt="" class="img-fluid">
                                                </a>
                                            </td>
                                            <td>
                                                @if ($upl->status == 'accept')
                                                    <a class="btn btn-success btn-sm">Accept</a>
                                                @elseif($upl->status == 'pending')
                                                    <a class="btn btn-secondary btn-sm">Pending</a>
                                                @elseif($upl->status == 'declined')
                                                    <a class="btn btn-danger btn-sm">Declined</a>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('editstatusuploadadmin/' . $upl->id_gallery) }}"
                                                    method="post">
                                                    @csrf
                                                    <select class="form-control form-select" name="changestatus"
                                                        id="" onchange="this.form.submit()">
                                                        <option selected>== Choose the status ==</option>
                                                        <option value="accept">Active</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="declined">Declined</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>Username</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Change Status</th>
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
