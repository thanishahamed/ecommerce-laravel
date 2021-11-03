<!--main area-->
<main id="main" class="main-site">
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class=" main-content-area">

            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    @if (session()->has('message'))
                    <div class="alert alert-warning">{{session('message')}}</div>
                    @endif
                    @foreach($cart_items as $item)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{asset($item->images[0]->slug)}}" alt=""></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="{{route('description',$item->id)}}">{{$item->name}}</a>
                        </div>
                        <div class="price-field product-price">
                            <p class="price">Rs. {{$item->price}}</p>
                        </div>
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" id='quantity{{$item->id}}' value="{{$item->quantity}}" data-max="{{$item->inventory->quantity}}" pattern="[1-9]*">
                                <button style="margin-left: 10px; color: red; font-weight: bold; border-radius: 30px; width: 30px; height: 30px;" href="#" wire:click="updateQuantity(Number(document.getElementById('quantity{{$item->id}}').value)-1,{{$item->cart_item_id}})">-</button>
                                <button style="margin-left: 10px; color: red; font-weight: bold; border-radius: 30px; width: 30px; height: 30px;" href="#" wire:click="updateQuantity(Number(document.getElementById('quantity{{$item->id}}').value)+1,{{$item->cart_item_id}})">+</button>
                            </div>
                            @if($item->inventory->quantity === 0)
                            <strong style="color: red;"> Out of stock </strong>
                            @else
                            <div> {{$item->inventory->quantity}} item(s) available </div>
                            @endif
                        </div>
                        <div class="price-field sub-total">
                            <p class="price">Rs. {{$item->total}}</p>
                        </div>
                        <!-- <div class="delete">
                            <button wire:click="deleteCartItem({{$item->cart_item_id}})">Delete </button>
                        </div> -->
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="" wire:click="deleteCartItem({{$item->cart_item_id}})">
                                <span>Delete from your cart</span>
                                <i class="fa fa-times-circle"></i>
                            </a>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index"> Rs. {{$sub_total}} </b></p>
                    <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">Rs. {{$sub_total}}</b></p>
                </div>
                <div class="checkout-info">
                    <!-- <label class="checkbox-field">
                        <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                    </label> -->
                    <a class="btn btn-checkout" href="{{route('checkout')}}">Check out</a>
                    <a class="link-to-shop" href="{{route('shop')}}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <!-- <div class="update-clear">
                    <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div> -->
            </div>

            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3>Most Viewed Products</h3>
                <livewire:on-sale-component />
                <!--End wrap-products-->
            </div>

        </div>
        <!--end main content area-->
    </div>
    <!--end container-->
</main>
<!--main area-->