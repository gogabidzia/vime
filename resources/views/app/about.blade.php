@extends('layouts.app')

@section('title')
ჩვენს შესახებ - Vime
@stop
@section('content')
@include('partials.headerbanner')

<div id="content">
	<div class="container">
		<h1 class="text-center segoefonted">ჩვენს შესახებ</h1>
		<p class="text-center">Vime.ge შეიქმნა 2017 წელს.
		ის საქართველოში პირველი ვიდეო ვაკანსიების (ვიზუმეების) საიტია.<br>

		ჩვენი მიზანია მომხმარებლის და დამსაქმებლის მარტივი დაკვაშირება ერთმანეთთან. </br> 

		დამატებითი ინფორმაცია თუ როგორი ვიზუმეები უნდა გამოუშვათ იხილეთ <a href="#" data-toggle="modal" data-target="#instructionsModal">ინსტრუქციაში</a>.</p>
	</div>
</div>
@stop