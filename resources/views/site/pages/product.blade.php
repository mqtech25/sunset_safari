@extends('site.app')
@section('title', $product->name)
@section('content')
@php
    $totalCount = $product->rattings->count();
    $fiveStarPercentage = $fourStarPercentage = $threeStarPercentage = $twoStarPercentage = $oneStarPercentage = $rattingPercentage = 0;
    if($totalCount>0){
        $fiveStarPercentage = ($rattingsCount["fivestar"]/$totalCount)*100;
        $fourStarPercentage = ($rattingsCount["fourstar"]/$totalCount)*100;
        $threeStarPercentage = ($rattingsCount["threestar"]/$totalCount)*100;
        $twoStarPercentage = ($rattingsCount["twostar"]/$totalCount)*100;
        $oneStarPercentage = ($rattingsCount["onestar"]/$totalCount)*100;
        $rattingPercentage = (($product->rattings->sum('ratting'))/($product->rattings->count()*5))*100;
    }
@endphp
<style>
    .start-bg{
        background-image: url('{{asset("storage/payment_img/star-bg.png")}}')
    }
    .user-rating-top-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg.png")}}');
        width: <?php echo $rattingPercentage ?>% !important;;
    }
    .user-rating-back-dynamic{
        background-image: url('{{asset("storage/payment_img/star-bg-dark.png")}}');
    }
    .bar-5{
        width: <?php echo $fiveStarPercentage ?>% !important;
    }
    .bar-4{
        width: <?php echo $fourStarPercentage ?>% !important;
    }
    .bar-3{
        width: <?php echo $threeStarPercentage ?>% !important;
    }
    .bar-2{
        width: <?php echo $twoStarPercentage ?>% !important;
    }
    .bar-1{
        width: <?php echo $oneStarPercentage ?>% !important;
    }

</style>
<section class="section-pagetop bg-primary">
    <div class="container clearfix">
        <h2 class="title-page">{{ $product->name }}</h2>
    </div>
</section>
<section class="section-content bg padding-y border-top" id="site">
    <div class="container">
        <div class="row">
			<div class="col-sm-12">
				@if(Session::has('message'))
				<p class="alert alert-success">{{ Session::get('message') }}</p>
				@endif
				@if(Session::has('Error'))
				<p class="alert alert-danger">{!! Session::get('Error') !!}</p>
				@endif
			</div>
		</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row no-gutters">
                        <aside class="col-sm-5 border-right">
                            <article class="gallery-wrap">
                                {{-- {{dd($product->mainProductThumbImage())}} --}}
                                @if ($product->images->count() > 0)
                                <div class="img-big-wrap">
                                    <div class="padding-y">
                                        <a id="main-img-full" href="{{ $product->singleProductFull() }}" data-fancybox="">
                                            <img id="gallery-main-img" src="{{ $product->singleProductThumb() }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="img-big-wrap">
                                    <div>
                                        <a href="#" data-fancybox=""><img src="//via.placeholder.com/176"></a>
                                    </div>
                                </div>
                                @endif
                                @if ($product->images->count() > 0)
                                <div class="img-small-wrap">
                                    @foreach($product->images as $productimage)
                                    {{-- {{dd($productimage)}} --}}
                                        <div class="item-gallery">
                                            @if($product->special_price!=$product->price)<div class="ribbon"><span>SALE</span></div>@endif
                                            <img src="{{ $productimage->path.'/'.json_decode($productimage->thumbs)->productThumb }}" data-product-page-thumb="{{ $productimage->path.'/'.json_decode($productimage->thumbs)->productPageThumb }}" data-fullurl="{{ $productimage->path.'/'.json_decode($productimage->thumbs)->full }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </article>
                        </aside>
                        <aside class="col-sm-7">
                            <article class="p-5">
                                <h3 class="title mb-1">{{ $product->name }} <small>{!! ($product->quantity>0) ? "<br><span class='text-success small'>In Stock (".$product->quantity.")</span>" : "<br><span class='text-danger small'>Out of Stock</span>"!!}</small> </h3>
                                <div class="rating-wrap mb-3">
                                    <div class="user-rating-back-dynamic">
                                        <div class="user-rating-top-dynamic"></div>
                                    </div>
                                    <span class="label-rating text-muted"> {{$product->rattings->count()}} reviews</span>
                                </div>
                                <dl class="row">
                                    <dt class="col-sm-3">SKU</dt>
                                    <dd class="col-sm-9">{{ $product->sku }}</dd>
                                    <dt class="col-sm-3">Weight</dt>
                                    <dd class="col-sm-9">{{ $product->weight }}</dd>
                                </dl>
                                <div class="mb-3">
                                    @if($product->special_price!=$product->price)
                                    <var class="price h3 text-danger">
                                        <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->special_price }}</span>
                                        <del class="price-old"> {{ config('settings.currency_symbol') }}{{ $product->price }}</del>
                                    </var>
                                    @else
                                    <var class="price h3 text-success">
                                        <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->price }}</span>
                                    </var>
                                    @endif
                                </div>
                                <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <dl class="dlist-inline">
                                                @foreach($attributes as $attribute)
                                                    @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                                    @if ($attributeCheck) 
                                                    {{-- {{dd($attribute)}} --}}
                                                        <hr>
                                                        @if($attribute->frontend_type == 'select')
                                                            <dt class="my-2">{{ $attribute->name }}: </dt>
                                                            <dd>
                                                                <select class="form-control form-control-sm option" style="width:180px;" name="{{ strtolower($attribute->name ) }}">
                                                                    <option data-price="0" value="0"> Select a {{ $attribute->name }}</option>
                                                                    @foreach($product->attributes as $attributeValue)
                                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                                            <option
                                                                            data-price="{{ $attributeValue->price }}"
                                                                            value="{{ $attributeValue->id }}"> {{ ucwords($attributeValue->value . ' +'. $attributeValue->price) }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </dd>
                                                        @elseif($attribute->frontend_type == 'text')
                                                            @foreach($product->attributes as $attributeValue)
                                                                @if ($attributeValue->attribute_id == $attribute->id)
                                                                    <div class="form-group mb-0">
                                                                        <label class="form-label" for="{{ strtolower($attribute->name ) }}"> {{ ucwords($attribute->name . ' +'.config('settings.currency_symbol'). $attributeValue->price) }}</label>
                                                                        <input type="text" class="form-control option" name="{{ $attribute->frontend_type."-".strtolower($attribute->name)."-". $attributeValue->id }}" id="" value="" data-price="{{ $attributeValue->price }}">
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @elseif($attribute->frontend_type == 'textarea')
                                                            @foreach($product->attributes as $attributeValue)
                                                                @if ($attributeValue->attribute_id == $attribute->id)
                                                                    <div class="form-group mb-0">
                                                                        <label class="form-label" for="{{ strtolower($attribute->name ) }}"> {{ ucwords($attribute->name . ' +'.config('settings.currency_symbol'). $attributeValue->price) }}</label>
                                                                        {{-- <input type="text" class="form-control option" name="{{ $attribute->frontend_type."-".strtolower($attribute->name)."-". $attributeValue->id }}" id="" value="" data-price="{{ $attributeValue->price }}"> --}}
                                                                        <textarea class="form-control option" name="{{ $attribute->frontend_type."-".strtolower($attribute->name)."-". $attributeValue->id }}" data-price="{{ $attributeValue->price }}"></textarea>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <dt class="my-2">{{ $attribute->name }}: </dt>
                                                            <dd>
                                                                @foreach($product->attributes as $key => $attributeValue)
                                                                    @if ($attributeValue->attribute_id == $attribute->id)
                                                                        <input class="option" type="radio" {{--{{($key == 0)?'checked':''}}--}} name="{{ strtolower($attribute->name ) }}" data-price="{{ $attributeValue->price }}" value="{{ $attributeValue->id }}"> {{ ucwords($attributeValue->value . ' +'.config('settings.currency_symbol'). $attributeValue->price) }}
                                                                    @endif
                                                                @endforeach
                                                            </dd>
                                                        @endif
                                                        {{-- <br> --}}
                                                    @endif
                                                @endforeach
                                        </dl>
                                    </div>
                                </div>
                                <hr>
                                @if($product->quantity>0)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <dl class="dlist-inline">
                                            <dt>Quantity: </dt>
                                            <dd>
                                                <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                                <input type="hidden" name="price" id="finalPrice" value="{{ ($product->special_price != $product->price) ? $product->special_price : $product->price }}">
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                @endif
                            </form>
                        </article>
                    </aside>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <article class="card mt-2">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews({{$product->rattings->count()}})</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="rating-wrap py-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{route('product.addratting')}}" id="ratting-form" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-12 pb-3">
                                                    <fieldset class="rating star">
                                                        <input type="radio" id="field6_star5" name="star_rating" value="5" /><label class = "full" for="field6_star5"></label>
                                                        <input type="radio" id="field6_star4" name="star_rating" value="4" /><label class = "full" for="field6_star4"></label>
                                                        <input type="radio" id="field6_star3" name="star_rating" value="3" /><label class = "full" for="field6_star3"></label>
                                                        <input type="radio" id="field6_star2" name="star_rating" value="2" /><label class = "full" for="field6_star2"></label>
                                                        <input type="radio" id="field6_star1" name="star_rating" value="1" /><label class = "full" for="field6_star1"></label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <textarea rows="5" class="form-control" id="product_review" name="product_review" placeholder="Write review"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group d-flex justify-content-end">
                                                        <input type="submit" id="submit-btn" class="btn btn-success" value="RATE">
                                                        <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
                                                        {{-- <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- ratting box --}}
                                    <div class="col-md-6">
                                        <span class="heading">User Rating</span>
                                        <div class="user-rating-back-dynamic">
                                            <div class="user-rating-top-dynamic"></div>
                                        </div>
                                        @if($product->rattings->count()>0)
                                            <p>{{round(($product->rattings->sum('ratting'))/($product->rattings->count()),1)}} average based on {{$product->rattings->count()}} reviews.</p>
                                        @endif
                                        <div class="row">
                                        <div class="side">
                                            <div>5 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                            <div class="bar-5"></div>
                                            </div>
                                        </div>
                                        <div class="side">
                                            <div>{{$rattingsCount["fivestar"]}}</div>
                                        </div>
                                        <div class="side">
                                            <div>4 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                            <div class="bar-4"></div>
                                            </div>
                                        </div>
                                        <div class="side">
                                            <div>{{$rattingsCount["fourstar"]}}</div>
                                        </div>
                                        <div class="side">
                                            <div>3 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                            <div class="bar-3"></div>
                                            </div>
                                        </div>
                                        <div class="side">
                                            <div>{{$rattingsCount["threestar"]}}</div>
                                        </div>
                                        <div class="side">
                                            <div>2 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                            <div class="bar-2"></div>
                                            </div>
                                        </div>
                                        <div class="side">
                                            <div>{{$rattingsCount["twostar"]}}</div>
                                        </div>
                                        <div class="side">
                                            <div>1 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                            <div class="bar-1"></div>
                                            </div>
                                        </div>
                                        <div class="side">
                                            <div>{{$rattingsCount["onestar"]}}</div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-reviews-wrap">
                                {{-- {{dd($product->rattings)}} --}}
                                <div class="container-fluid">
                                    @forelse ($product->rattings as $ratting)
                                        <div class="row mt-1 mb-3">
                                            <p><div class="start-bg d-flex"><span class="w-100 text-center my-auto font-weight-bold text-white">{{$ratting->ratting}}</span></div>
                                                <span class="ml-4"><i class="fas fa-comments"> </i> {{$ratting->review}} <br><small>{{$ratting->created_at->diffForHumans()}} , {{$ratting->user->first_name." ".$ratting->user->last_name}}</small></span>
                                            </p> 
                                        </div>
                                    @empty
                                        <p>No review(s) yet</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
</section>
@endsection
@push('custom-scripts')
<script>
    $(document).ready(function () {
        $('#addToCart').submit(function (e) {
            var validation = true;
            var uniqueAttributes = [];
            var inputs = new Array();
            $('.option').each(function() {
                if(!inputs.includes($(this).attr('name'))){
                    inputs.push($(this).attr('name'));
                }
            });
            let unique = [...new Set (inputs)];
            unique.forEach(function(item,index){
                var elem = document.getElementsByName(item);
                console.log(elem);
                if(elem[0].nodeName == "SELECT" && elem[0].value == 0){
                    validation = false;
                }else if(elem[0].nodeName == "INPUT" && $("input[name="+item+"]:checked").val() == undefined){
                        validation = false;
                }else if(elem[0].nodeName == "INPUT" && elem[0].type == "text" && elem[0].value == null){
                        validation = false;
                }
            });
            if (!validation) {
                e.preventDefault();
                alert('Please select an option');
                return;
            }
        });

        $('.option').change(function () {
            var extraPrice = 0;
            $('.option').each(function() {
                if($(this).attr('type') == 'radio' && $(this).is(':checked'))
                {
                    extraPrice = extraPrice+Number($(this).data('price'));
                }else if($(this).is("textarea")){
                    extraPrice += Number($(this).data('price'));
                }else if($(this).attr('type') == 'text' && $(this).val()!=null){
                    if($(this).val() != ''){
                        extraPrice += Number($(this).data('price'));
                    }
                }else if($(this).is("select")){
                    extraPrice += Number($(this).find(':selected').data('price'));
                }
            });
            $('#productPrice').html("{{ $product->special_price != $product->price ? $product->special_price : $product->price }}");
            let actualPrice = '{{$product->special_price != $product->price ? $product->special_price : $product->price}}';
            let finalPrice = ((extraPrice) + Number(actualPrice)).toFixed(2);
            $('#finalPrice').val(finalPrice);
            $('#productPrice').html(finalPrice);
        });

        $("label").click(function(){
            $(this).parent().find("label").css({"background-color": "#6e6e6d"});
            $(this).css({"background-color": "orange"});
            $(this).nextAll().css({"background-color": "orange"});
        });
        
        $(".star label").click(function(){
            $(this).parent().find("label").css({"color": "#6e6e6d"});
            $(this).css({"color": "orange"});
            $(this).nextAll().css({"color": "orange"});
            $(this).css({"background-color": "transparent"});
            $(this).nextAll().css({"background-color": "transparent"});
        });

        $(".item-gallery img").on('click',function(){
            var newSource = $(this).data('product-page-thumb');
            var newFullSource = $(this).data('fullurl');
            // alert(newSource+'@======@'+newFullSource);exit;
            $("#gallery-main-img").attr('src',newSource);
            $("#gallery-main-img").parent().attr('href',newFullSource);
        });
    });
</script>
@endpush
