@extends('web.layout.master')
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle">
  <div class="container">
      <div class="row">
          <div class="col-xs-12">
              <div class="titleTable">
                  <div class="titleTableInner">
                      <div class="pageTitleInfo">
                          <h1>Hướng dẫn mua vé </h1>
                          <div class="under-border"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<section class="mainContentSection">
  @include("web.ticket_guide." . app()->getLocale())
</section>
@endsection