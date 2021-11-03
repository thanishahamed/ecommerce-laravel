<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <div class="wrap-address-billing">

                <h3 class="box-title">Billing Address</h3>
                <form action="#" method="get" name="frm-billing">
                    <p class="row-in-form">
                        <label for="fname">first name<span>*</span></label>
                        <input id="fname" type="text" name="fname" value="" wire:model="firstname" placeholder="Your name">
                        @if($errors->has('firstname'))
                        <span class="text-danger text-strong"> {{$errors->first('firstname')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="lname">last name<span>*</span></label>
                        <input id="lname" type="text" name="lname" value="" wire:model="lastname" placeholder="Your last name">
                        @if($errors->has('lastname'))
                        <span class="text-danger text-strong"> {{$errors->first('lastname')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="email">Email Addreess:</label>
                        <input id="email" type="email" name="email" value="" wire:model="email" placeholder="Type your email">
                        @if($errors->has('email'))
                        <span class="text-danger text-strong"> {{$errors->first('email')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="phone">Phone number<span>*</span></label>
                        <input id="phone" type="number" name="phone" value="" wire:model="telephone" placeholder="10 digits format">
                        @if($errors->has('telephone'))
                        <span class="text-danger text-strong"> {{$errors->first('telephone')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="add">Address:</label>
                        <input id="add" type="text" name="add" value="" wire:model="address" placeholder="Street at apartment number">
                        @if($errors->has('address'))
                        <span class="text-danger text-strong"> {{$errors->first('address')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="country">Country<span>*</span></label>
                        <input id="country" type="text" name="country" value="" wire:model="country" placeholder="United States">
                        @if($errors->has('country'))
                        <span class="text-danger text-strong"> {{$errors->first('country')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="zip-code">Postcode / ZIP:</label>
                        <input id="zip-code" type="number" name="zip-code" wire:model="postalcode" value="" placeholder="Your postal code">
                        @if($errors->has('postalcode'))
                        <span class="text-danger text-strong"> {{$errors->first('postalcode')}} </span>
                        @endif
                    </p>
                    <p class="row-in-form">
                        <label for="city">Town / City<span>*</span></label>
                        <input id="city" type="text" name="city" value="" wire:model="city" placeholder="City name">
                        @if($errors->has('city'))
                        <span class="text-danger text-strong"> {{$errors->first('city')}} </span>
                        @endif
                    </p>

                </form>
            </div>
            <div class="summary summary-checkout">
                <div class="summary-item payment-method">
                    <h4 class="title-box">Payment Method</h4>
                    <p class="summary-info"><span class="title">Check / Money order</span></p>
                    <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-bank" value="bank" type="radio" disabled checked>
                            <span>Direct Bank Transfer</span>
                            <span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-visa" value="visa" type="radio" disabled>
                            <span>visa</span>
                            <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio" disabled>
                            <span>Paypal</span>
                            <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span>
                        </label>
                        @if($errors->has('paymentmethod'))
                        <span class="text-danger text-strong"> {{$errors->first('paymentmethod')}} </span>
                        @endif
                    </div>
                    <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">Rs. {{$sub_total}}</span></p>
                    <button href="" class="btn btn-medium" wire:click="placeOrder">Place order now</button>
                </div>
                <div class="summary-item shipping-method">
                    <!-- <h4 class="title-box f-title">Shipping method</h4> -->
                    <!-- <p class="summary-info"><span class="title">Flat Rate</span></p>
                    <p class="summary-info"><span class="title">Fixed $50.00</span></p> -->
                    <!-- <h4 class="title-box">Discount Codes</h4> -->
                    <!-- <p class="row-in-form">
                        <label for="coupon-code">Enter Your Coupon code:</label>
                        <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="">
                    </p>
                    <a href="#" class="btn btn-small">Apply</a> -->
                </div>
            </div>

        </div>
        <!--end main content area-->
    </div>
    <!--end container-->

</main>