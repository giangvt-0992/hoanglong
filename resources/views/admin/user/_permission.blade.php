<div class="x_title">
  <h2><i class="fa fa-bars"></i> Danh sách chức năng</h2>
  <div class="clearfix"></div>
</div>
<div class="x_content">
  <table class="table table-bordered" id="datatable2">
    <thead>
      <tr>
        <th>Tên</th>
        <th>Slug</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($permissions as $permission)
      <tr>
        <td scope="row">{{$permission->name}}</td>
        <td>{{$permission->slug}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>