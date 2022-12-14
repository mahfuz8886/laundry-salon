@extends('backEnd.layouts.master')
@section('nearest_zone', 'active menu-open')
@section('nearest_zone_manage', 'active')
@section('title', 'Manage Nearestzone')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card custom-card">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>Manage Nearestzone</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/nearestzone/add') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            <i class="fa fa-plus"></i> Add New
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nearestzone Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($show_data as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->zonename }}</td>
                                                <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <ul class="action_buttons">
                                                        <li>
                                                            @if ($value->status == 1)
                                                                <form action="{{ url('admin/nearestzone/inactive') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="hidden_id"
                                                                        value="{{ $value->id }}">
                                                                    <button type="submit" class="thumbs_up"
                                                                        title="unpublished"><i
                                                                            class="fa fa-thumbs-up"></i></button>
                                                                </form>
                                                            @else
                                                                <form action="{{ url('admin/nearestzone/active') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="hidden_id"
                                                                        value="{{ $value->id }}">
                                                                    <button type="submit" class="thumbs_down"
                                                                        title="published"><i
                                                                            class="fa fa-thumbs-down"></i></button>
                                                                </form>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <a class="edit_icon"
                                                                href="{{ url('admin/nearestzone/edit/' . $value->id) }}"
                                                                title="Edit"><i class="fa fa-edit"></i></a>
                                                        </li>
                                                        <!--<li>-->
                                                        <!--  <form action="{{ url('admin/nearestzone/delete') }}" method="POST">-->
                                                        <!--    @csrf-->
                                                        <!--    <input type="hidden" name="hidden_id" value="{{ $value->id }}">-->
                                                        <!--    <button type="submit" onclick="return confirm('Are you delete this this?')" class="trash_icon" title="Delete"><i class="fa fa-trash"></i></button>-->
                                                        <!--  </form>-->
                                                        <!--</li>-->
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Section  -->




@endsection
