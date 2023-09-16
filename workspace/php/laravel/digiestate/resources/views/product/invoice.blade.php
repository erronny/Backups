@extends('layouts.master')
@section('content')
    <div class="product-cart-area mg-tb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-cart-inner">
                        <div id="example-basic">
                            <h3>Shopping Cart</h3>
                            <section>
                                <h3 class="product-cart-dn">Shopping</h3>
                                <div class="product-list-cart">
                                    <div>
                                        @if(Session::has('message'))
                                        <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
                                        @endif

                                        @if(Session::has('error'))
                                        <div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
                                        @endif
                                    </div>
                                    <div class="text text-right">
                                        <a href="{{URL('admin/'.$back_url)}}" class="btn btn-primary"><i class="fa fa-list1"></i>Back</a>
                                    </div>
                                    <div class="product-status-wrap border-pdt-ct">
                                        <table class="table">
                                             <tr>
                                                <th width="10%">Image</th>
                                                <th width="50%">Product Title</th>
                                                <th width="10%" style="text-align: center;">Price</th>
                                                <th width="10%">Quality</th>
                                                {{-- <th width="10%" style="text-align: center;">Discount</th> --}}
                                                <th width="20%" style="text-align: center;">Total</th>
                                                <!-- <th width="10%" style="text-align: center;">Action</th> -->
                                            </tr>
                                            <?php 
                                               $total=$subtotal=$grandtotal = 0;
                                             ?>
                                             @if(!empty($products))
                                                @foreach($products as $key=>$product)
                                                    @php 
                                                        $total+=$product->quantity*$product->price;
                                                        $subtotal+=$product->quantity*$product->price;
                                                        $grandtotal+=$product->quantity*$product->price; 
                                                    @endphp

                                                     <tr>
                                                        <td><img style="width: 100px" src="{{ asset("assets/img/product/".$product->attributes->image) }}" alt="" /></td>
                                                        <td>
                                                            <h3><a href="{{URL('/admin/updateDetail/'.$product->id)}}">{{$product->name}}</a></h3>
                                                            
                                                            <!-- <p>Lorem ipsum dolor sit consec te imperdiet iaculis ipsum.</p> -->
                                                        </td>
                                                        <td style="text-align: center;">${{number_format($product->price,2)}}</td>
                                                        <td>{{$product->quantity}}</td>
                                                        {{-- <td style="text-align: center;">{{$product->attributes->discount}}</td> --}}
                                                        <td style="text-align: center;">${{number_format($product->quantity*$product->price,2)}}</td>
                                                       <!--  <td style="text-align: center;">
                                                            
                                                            <a href="{{URL('admin/removeItem/'.$product->id)}}" data-toggle="tooltip" title="Trash" class="pd-setting-ed btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td> -->
                                                    </tr>


                                                   
                                                @endforeach
                                      <tr>
                                           <td colspan="5" style="text-align: right;"><b>Total&nbsp;&nbsp;</b></td>
                                        
                                           <td  colspan="2" style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>${{number_format($total,2)}}</b></td>
                                       </tr>
                                        <tr>
                                           <td colspan="5" style="text-align: right;"><b>Sub Total&nbsp;&nbsp;</b></td>
                                          
                                           <td  colspan="2" style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>${{number_format($subtotal,2)}}</b></td>
                                       </tr>
                                        <tr>
                                           <td colspan="5" style="text-align: right;"><b>Grand Total&nbsp;&nbsp;</b></td>
                                           
                                           <td  colspan="2" style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>${{number_format($grandtotal,2)}}</b></td>
                                       </tr>
                                            @else
                                            <tr>
                                                <td colspan="6" class="alert alert-danger">No Item</td>
                                            </tr>
                                            @endif
                                           
                                        </table>
                                    </div>

                                     @if(!empty($products))

                                    <div class="row form-group">
                                   
                                   
                                     <div class="col-sm-8"></div>
                                </div>
                                 @else
                                   
                                           
                                 @endif
                                
                                </div>


                                
                            </section>
                           
                          {{--   <h3>Confirmation</h3>
                            <section>
                                <div class="product-confarmation">
                                    <h2>Congratulations! Your Order is accepted.</h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                                        it to make a type specimen book.</p>
                                    <button class="btn btn-primary m-y">Track Order</button>
                                </div>
                            </section> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extrajs')

<style type="text/css">
  .actions {
    display: none !important;
  }
</style>
 <script src="{{ asset('assets/js/wizard/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/js/wizard/steps-active.js') }}"></script>
@endsection