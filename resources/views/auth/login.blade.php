@extends('layouts.app')

@section('title')
Vime - ავტორიზაცია
@stop
@section('content')
<div class="loginContent myFormControl" >
	<h3 class="text-center">
                შესვლა
            </h3>
    <form action="/login" method="post">
        <div class="form-group">
            <input class="form-control" name="email" placeholder="ელ.ფოსტა"></input>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="პაროლი"></input>
        </div>
        {{csrf_field()}}
        <div class="pull-left">
            <a href="#" class="forgot_password">პაროლის გახსენება</a>
        </div>
        <a tabindex="-1" style="width: 100%; margin-bottom: 15px; font-size: 17px;" href="/facebook/login" class="btn btn-primary text-center"><i class="fa fa-facebook-official"></i> Facebook ავტორიზაცია</a>
        <div class="pull-right">
            <button class="btn authBtn" type="submit" name="">შესვლა</button> 
        </div>
        <div class="clearfix"></div>
    </form>
</div>
@stop
