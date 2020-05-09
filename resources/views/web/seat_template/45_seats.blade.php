<table class="table floor ">
  <tbody><tr>
    <td width="9%"><div align="center"></div></td>
    <td width="9%" style="border: none;"></td>
    <td width="9%" rowspan="12" style="border: none;"><div align="center"></div></td>
    <td width="9%" ><div align="center"></div></td>
    <td width="9%"><div align="center"></div></td>
  </tr>
  <tr>
    <td><div class=" seat seat-gray m-auto" data-id=""></div></td>
    <td></td>
    <td><div class=" seat m-auto @if (!in_array(1, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="1">01</div></td>
    <td><div class=" seat m-auto @if (!in_array(2, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="2">02</div></td>
  </tr>
  <tr>
    <td><div class=" seat m-auto @if (!in_array(3, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="3">03</div></td>
    <td><div class=" seat m-auto @if (!in_array(4, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="4">04</div></td>
  </tr>
  <?php $x = 45 - 5; ?>
  @for ($i = 5; $i <= $x; )
    <tr>
      <td><div class=" seat m-auto @if (!in_array($i, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="{{$i}}">{{substr("0".$i++,-2)}}</div></td>
      <td><div class=" seat m-auto @if (!in_array($i, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="{{$i}}">{{substr("0".$i++,-2)}}</div></td>
      <td><div class=" seat m-auto @if (!in_array($i, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="{{$i}}">{{substr("0".$i++,-2)}}</div></td>
      <td><div class=" seat m-auto @if (!in_array($i, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="{{$i}}">{{substr("0".$i++,-2)}}</div></td>
    </tr>
  @endfor
  <tr>
    @for ($x=$x+1; $x <= 45; $x++)
    <td><div class=" seat m-auto @if (!in_array($x, $seatMap)) seat-default book-seat @else seat-gray @endif" data-id="{{$x}}">{{substr("0".$x,-2)}}</div></td>
    @endfor
  </tr>
</tbody></table>