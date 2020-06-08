<div class="x_title">
  <h2><i class="fa fa-bars"></i> Danh sách quyền</h2>
  <a href="{{route('admin.role.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Thêm quyền</a>
  <div class="clearfix"></div>
</div>
<div class="x_content">
  <table class="table table-bordered" id="datatable1">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Slug</th>
        <th class="text-center">Cập nhật</th>
        <th class="text-center">Xóa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $role)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$role->name}}</td>
        <td>{{$role->slug}}</td>
        <td class="text-center"><a href="{{route('admin.role.update', ['role' => $role->id])}}" class="btn btn-warning" ><i class="fas fa-pencil-alt"></i></a></td>
        <td class="text-center"><a href="{{route('admin.role.destroy', ['role' => $role->id])}}" class="btn btn-danger btn-delete" data-page="role"><i class="fa fa-trash"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


