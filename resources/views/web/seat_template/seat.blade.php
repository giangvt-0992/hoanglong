
<div class="col-sm-8 col-md-8 col-xs-12 col-md-offset-2">
  <?php
    $seatCount = count($seatMap) ?? 0;
  ?>
  <div class="col-sm-6 col-md-6 col-xs-12">
    <div class="seat-description-wrapper">
      <div>
        <div class="seat-description">
          <div class="seat seat-default"></div>
          <p>Ghế trống</p>
        </div>
        <div class="seat-description">
          <div class="seat seat-blue"></div>
          <p>Ghế bạn chọn</p>
        </div>
        <div class="seat-description">
          <div class="seat seat-gray"></div>
          <p>Ghế đã được đặt</p>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="col-sm-6 col-md-6 col-xs-12">
    @include("web.seat_template.".$seatCount."_seats", [
      'seatMap' => $seatMap
    ])
  </div>
</div>
