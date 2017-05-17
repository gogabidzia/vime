@extends('layouts.app')
@section('title')
	კომპანიის გვერდი - VIME
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			<div class="userParam">
				<div class="avatar">
					<img src="img/avatar.png">
				</div>
				<h4 class="username">
					{{ Auth::user()->name }} {{ Auth::user()->surname }}
					<span class="edit">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</span>
				</h4>
				<div class="param">
					ნომერი : {{ Auth::user()->phone }}
				</div>
				<div class="param">
					ელ.ფოსტა : {{ Auth::user()->email }}
				</div>
				<div class="param">
					ვაკანსიები : 1
				</div>
				<div class="param">
					რეზიუმეები : 4
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="vacancies">
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title red">
								გაგზავნილი რეზიუმეები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items vips">
					<div class="row">
						<div class="col-md-4">
							<div class="item">
								<div class="row">
									<div class="col-md-4">
										<div class="icon">
											<img src="img/company.png">
										</div>
									</div>
									<div class="col-md-8">
										<div class="title">
											გაყიდვების მენეჯერი
										</div>
										<div class="company_name">
											"კომპანია"
										</div>
										<div class="absoluted">
											<div class="dates">
												00.00.00 - 00.00.00
											</div>
											<div class="location">
												თბილისი
											</div>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
				<!-- VIPS END -->
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green">
								შენახული ვაკანსიები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
					<div class="row">
						<div class="col-md-12">
							<div class="item">
								<div class="row">
									<div class="icon pull-left">
										<img src="img/company.png">
									</div>
									<div class="pull-left marginleft">
										<div class="title">
											გაყიდვების მენეჯერი
										</div>
										<div class="company_name">
											"კომპანია"
										</div>
									</div>
									<div class="pull-right marginright">
										<div class="dates">
											00.00.00 - 00.00.00
										</div>
										<div class="location">
											თბილისი
										</div>
									</div>
									<div class="clearfix"></div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-2"></div>
	</div>
@stop