@if(!empty($cart))
    @if($cart->cartdetail->count() != 0)
        @php
            $totalprice = 0;
        @endphp
        <ul class="cart_product">
        @foreach($cart->cartdetail as $dets)
        @php
            $totalprice = (int)$totalprice + ((int)$dets->qty*(int)$dets->product->final_price);
        @endphp
        <li>
            <div class="media">
                <a href="#"><img class="mr-3" style="width:50px;" src="{{url('images/'.$dets->product->image)}}" alt="Generic placeholder image"></a>
                <div class="media-body">
                <a href="#"><h4>{{ $dets->product->name }}</h4></a>
                <h4><span>{{ $dets->qty }} x IDR {{ number_format($dets->product->final_price) }}</span></h4>
                </div>
            </div>
            <div class="close-circle ">
            <a href="#" class="deletecart" data-productid="{{ $dets->id }}"><i class="ti-trash" aria-hidden="true"></i></a>
            </div>
        </li>
        @endforeach
      </ul>
      <ul class="cart_total">
        <li>
            <div class="total">
            <h5>subtotal : <span>IDR {{ number_format($totalprice) }}</span></h5>
            </div>
        </li>
        <li>
            <div class="buttons">
                <a href="{{route('cart.viewcart')}}" class="btn btn-solid btn-xs checkout">checkout</a>
            </div>
        </li>
      </ul>

    @else
        <h5>Empty Cart</h5>
    @endif

@else
<h5>Empty Cart</h5>
@endif
