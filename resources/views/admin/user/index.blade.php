@extends('admin.layout.app')
@section('content')
<div class="right_col" role="main">
	<div class="" style="margin-top: 50px;">
		@include('admin.layout.flash')
		<div class="page-title">
			<div class="title_left">
				<p>Home / Người dùng và phân quyền</p>
			</div>
		</div>
		<div class="clearfix"></div>
    
    <div class="">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <?php $tab = request()->tab ?? 'user'; ?>
              <li role="presentation" class="@if ($tab === 'user') active @endif"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Người dùng</a>
              </li>
              <li role="presentation" class="@if ($tab === 'role') active @endif"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Quyền</a>
              </li>
              <li role="presentation" class="@if ($tab === 'permission') active @endif"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Chức năng</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade @if ($tab === 'user') active in @endif" id="tab_content1" aria-labelledby="home-tab">
                @include('admin.user._user', [
                  'admins' => $admins,
                  'roles' => $roles,
                  'permissions' => $permissions
                ])
              </div>
              <div role="tabpanel" class="tab-pane fade @if ($tab === 'role') active in @endif" id="tab_content2" aria-labelledby="profile-tab">
                  @include('admin.role.index', [
                    'roles' => $roles
                  ])
              </div>
              <div role="tabpanel" class="tab-pane fade @if ($tab === 'permission') active in @endif" id="tab_content3" aria-labelledby="profile-tab">
                @include('admin.user._permission', [
                  'permissions' => $permissions
                ])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
@endsection
@section('after-scripts')
<script>
	$("#datatable").DataTable();
</script>
@endsection
