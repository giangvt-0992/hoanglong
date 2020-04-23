@if (Session::has('success'))
<div class="col-12 alert alert-success alert-dismissible fade in flash-alert" style="padding: 20px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <span>{{Session::get('success')}}</span>
</div>
@endif
@if (Session::has('warning'))
<div class="col-12 alert alert-warning alert-dismissible fade in flash-alert" style="padding: 20px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <span>{{Session::get('warning')}}</span>
</div>
@endif
@if (Session::has('danger'))
<div class="col-12 alert alert-danger alert-dismissible fade in flash-alert" style="padding: 20px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <span>{{Session::get('danger')}}</span>
</div>
@endif
