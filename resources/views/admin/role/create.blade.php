@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<p>Home / Người dùng và phần quyền / Thêm quyền</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Thêm quyền</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
            <br />
            <div class="col-md-8 center-margin">
              <form class="form-horizontal form-label-left" method="POST" action="{{route('admin.role.store')}}">
                @csrf
                <div class="form-group">
                  <label>Tên quyền</label>
                  <input type="text" class="form-control" placeholder="Tên vai trò" name="name" value="{{old('name')}}">
                  @if($errors->has('name'))
                  <span class="text-danger">{{$errors->first('name')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Chức năng</label>
                  <ul class="to_do">
                    <?php $oldPermisisons = old('permissions') ?? []; ?>
                    @foreach ($permissions as $permission)
                    <li class="col-md-4">
                      <input type="checkbox" class="flat" name="permissions[]" value="{{$permission->id}}"
                      @if (in_array($permission->id, $oldPermisisons))
                      checked
                      @endif
                      > {{$permission->name}}
                    </li>
                    @endforeach
                  </ul>
                  @if($errors->has('permissions'))
                  <span class="text-danger">{{$errors->first('permissions')}}</span>
                  @endif
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button class="btn btn-primary btn-cancel" type="button" data-next-route="{{route('admin.user.index', ['tab' => 'role'])}}" >Hủy</button>
                  </div>
                </div>
              </form>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
