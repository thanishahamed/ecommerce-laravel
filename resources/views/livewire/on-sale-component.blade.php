<!--On Sale-->
<div class="wrap-show-advance-info-box style-1 has-countdown">
    <h3 class="title-box">On Sale</h3>
    <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

        @foreach($products as $product)
        <div class="product product-style-2 equal-elem ">
            <div class="product-thumnail">
                <a href="{{route('description', $product->id)}}" title="{{$product->name}}">
                    @if(count($product->images) > 0)

                    <figure><img src="{{asset($product->images[0]->slug)}}" width="800" height="800" alt=""></figure>
                    @else
                    <figure><img src="https://nayemdevs.com/wp-content/uploads/2020/03/default-product-image.png" width="800" height="800" alt=""></figure>
                    @endif
                </a>
                <div class="group-flash">
                    <span class="flash-item sale-label">sale</span>
                </div>
                <div class="wrap-btn">
                    <a href="#" class="function-link">quick view</a>
                </div>
            </div>
            <div class="product-info">
                <a href="#" class="product-name"><span>{{$product->name}}</span></a>
                <div class="wrap-price">
                    @if($product->discount_id)
                    <ins>
                        <p class="product-price">LKR {{$product->price}}</p>
                    </ins>
                    <del>
                        <p class="product-price">LKR {{$product->price+100}}</p>
                    </del>
                    @else
                    <ins>
                        <p class="product-price">$168.00</p>
                    </ins>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>