<div class="x_title">
  <h2><i class="fa fa-bars"></i> Danh sách người dùng</h2>
  <a href="{{route('admin.user.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm người dùng</a>
  <div class="clearfix"></div>
</div>
<div class="x_content">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Role</th>
        <th>Hãng xe</th>
        <th>Trạng thái</th>
        <th class="text-center">Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($admins as $admin)
      <tr>
        <td>{{$loop->index}}</td>
        <td>{{$admin->name}}</td>
        <td>{{$admin->email}}</td>
        <td>{{$admin->role->name}}</td>
        <td>{{$admin->brand->name ?? ''}}</td>
        <td>{{$admin->is_active == true ? 'Hoạt động' : 'Ngưng hoạt động'}}</td>
        <td class="text-center">
          {{-- <a href="{{route('admin.user.destroy', ['admin' => $admin->id])}}" class="btn btn-danger btn-delete" data-page="role"><i class="fa fa-trash"></i></a> --}}
          @if ($admin->is_active == config('constants.IS_ACTIVE_STATUS.ACTIVE'))
          <a href="{{route('admin.user.deactivate', ['admin' => $admin->id])}}" class="btn btn-danger btn-danger btn-deactivate" data-page="user" title="Ngưng kích hoạt" ><i class="fa fa-trash"></i></a>
          @else 
          <a href="{{route('admin.user.active', ['admin' => $admin->id])}}" class="btn btn-success btn-active" data-page="user" title="Kích hoạt"><i class="fa fa-recycle"></i></a>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
