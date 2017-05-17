@extends('layouts.app')

@section('title')
Vime - მთავარი
@stop
@section('content')
@include('partials.headerbanner')

<div id="content">
	<div class="row">
		<div class="col-md-2">123</div>

		<div class="col-md-8">
			<div class="vacancies">
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title red">
								VIP განცხადებები
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
									<div class="col-xs-4">
										<div class="icon">
											<img src="img/company.png">
										</div>
									</div>
									<div class="col-xs-8">
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
								სტანდარტული
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

		<div class="col-md-2">
			<div id="advertisements">
				asd
			</div>
		</div>
	</div>	
</div>
@stop