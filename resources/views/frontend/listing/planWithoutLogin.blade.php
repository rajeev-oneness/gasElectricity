@extends('frontend.layouts.master')
@section('title','Plan Listing')
@section('css')
<style>
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #279679;
    border-color: #007bff;
    width: 47px;
    height: 47px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 600;
    border: 1px solid #279679;
    border-radius: 3px;
}
.page-item:first-child .page-link {
	z-index: 3;
    color: #000;
    background-color: white;
    border-color: #007bff;
    width: 47px;
    height: 47px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 600;
    border: 1px solid #c7c7c7;
    border-radius: 3px;
}
.pagination {
	justify-content: flex-end;
}
</style>
@endsection
@section('content')
<section class="plan_listing_wraper">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-md-7">
				<div class="custom-control custom-checkbox custom-control-mod">
			        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
			        <label class="custom-control-label" for="customControlAutosizing">Just compare plans which link to a Referral Partner's website.</label>
			    </div>
			</div>
			<div class="col-12 col-md-5 text-right">
				<div class="filter_wrap">
					<div class="filter_icon">
						<img src="{{asset('forntEnd/images/filter.png')}}">
					</div>
					<div class="dropdown filter_selected">
					  	<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><p><span>Sorted by:</span>Value Score</p> <img src="{{asset('forntEnd/images/double-arrow-down.png')}}"></a>

					 	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						    <a class="dropdown-item" href="#">Action</a>
						    <a class="dropdown-item" href="#">Another action</a>
						    <a class="dropdown-item" href="#">Something else here</a>
					  	</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="plan_listing_items">
					<div class="plan_listing_header">
						<p>Based on the general usage^ in the Energex network the AER reference price is: <span>$1,508 / year</span></p>
					</div>
					<div class="plan_title_wrap">
						<h5>Plan <span>and highlights</span></h5>
						<h5>Price/year <span>(estimated^)</span></h5>
					</div>
					<div class="plan_tab">
						<h5>Sponsored</h5>
						<a href="#" class="close-panel">CLOSE</a>
					</div>
					<div class="plan_wraper">
						@foreach ($productData as $data)
						<div class="plane_list_wrapper">
							<div class="res-planheading"><h5>Plan <span>and highlights</span></h5></div>
							<div class="list_container_first wid-pad">
								<h4>{{$data->name}}</h4>
								<ul class="reward_facilities">
									@forelse ($data->feature as $featureData)
									<li>{{$featureData->title}}</li>
									@empty
									<li>N/A</li>
									@endforelse
								</ul>
								<div class="plan_info">
									<p>{{$data->tag}} <img src="{{asset('forntEnd/images/question.png')}}"></p>
								</div>
							</div>
							<div class="res-planheading"><h5>Price/year <span>(estimated^)</span></h5></div>
							<div class="list_amount mb-0">
								<div class="list_amount_inner">
									<div class="price_compare">
										<span><img src="{{asset('forntEnd/images/fire-icon.png')}}">Gas</span>
										<h2>{{$data->gas_data->title}}</h2>
									</div>
									<div class="price_amount">
										<h2>${{$data->gas_data->price}}</h2>
									</div>
								</div>
								<div class="list_amount_inner">
									<div class="price_compare">
										<span><img src="{{asset('forntEnd/images/lightbulb.png')}}">ELECTRICITY</span>
										<h2>{{$data->electricity_data->title}}</h2>
										<p>than reference price</p>
									</div>
									<div class="price_amount">
										<h2>${{$data->electricity_data->price}}</h2>
										<a href="{{route('plan.details',$data->id)}}" class="blue-btm">EXPLORE <span><i class="fas fa-arrow-circle-right"></i></span></a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						

						<div class="plane_list_wrapper plane_list_wrapper-mod">
							<div class="res-planheading"><h5>Plan <span>and highlights</span></h5></div>
							<div class="list_container_first">
								<h4>Reamped Advance</h4>
								<ul class="reward_facilities">
									<li>Sign Up & get up to 10K Everyday Rewards Points</li>
								</ul>
								<div class="plan_info ctrladvance">
									<p>Basic Plan Information <img src="{{asset('forntEnd/images/question.png')}}"></p>
								</div>
							</div>

							<div class="plan_value">
								<h4>Value <span>(out of 10)</span></h4>
								<img src="{{asset('forntEnd/images/rating.png')}}">
							</div>
							<div class="res-planheading"><h5>Price/year <span>(estimated^)</span></h5></div>
							<div class="list_amount mb-0">
								<div class="list_amount_inner">
									<div class="price_compare">
										<span><img src="{{asset('forntEnd/images/fire-icon.png')}}">Gas</span>
										<h2>17% less</h2>
									</div>
									<div class="price_amount">
										<h2>$9,252</h2>
									</div>
								</div>
								<div class="list_amount_inner">
									<div class="price_compare">
										<span><img src="{{asset('forntEnd/images/lightbulb.png')}}">ELECTRICITY</span>
										<h2>15% less</h2>
										<p>than reference price</p>
									</div>
									<div class="price_amount">
										<h2>$1,252</h2>
										<a href="{{route('plan.details',1)}}" class="blue-btm">EXPLORE <span><i class="fas fa-arrow-circle-right"></i></span></a>
									</div>
								</div>
							</div>
						</div>
						
					</div>

					<ul class="plan_pagination justify-content-end">
						{!!$productData->links()!!}
					</ul>
				</div>
				<div class="important_note_wrap">
					<div class="note_title">
						<div class="trigger">+</div>
						<div class="note_title_head">
							<p>IMPORTANT NOTES</p>
						</div>
					</div>
					<div class="note_content">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('script')
    <script type="text/javascript">
    	$(document).ready(function(){
	  		$(".trigger").click(function(){
	    		$(".note_content").slideToggle("fast");
	  		});
		});
		$(document).ready(function(){
	  		$(".close-panel").click(function(){
	    		$(".plan_wraper").slideToggle("fast");
	  		});
		});
    </script>
@stop
@endsection