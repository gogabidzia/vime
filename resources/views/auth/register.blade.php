@extends('layouts.app')
@section('title')
Vime - რეგისტრაცია
@stop
@section('content')
    <div class="container">
        <div id="register" class="pull-left">
            <h3 class="text-center">რეგისტრაცია</h3>
            <div class="errors alert alert-danger" style="display: none;">
            </div>
            <div class="typeswitcher">
                <div class="switchbtn user active">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    მომხმარებელი
                </div>
                <div class="switchbtn company">
                    <i class="fa fa-suitcase" aria-hidden="true"></i>
                    კომპანია
                </div>
            </div>
            <div class="forms">
                <form id="user_form" class="form_hide user" method="post" action="/register">
                    {{csrf_field()}}
                    <input type="hidden" name="isuser" value="1">
                    <div class="form-group">
                        <input class="form-control" name="name" placeholder="სახელი"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="surname" placeholder="გვარი"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="email" placeholder="ელ.ფოსტა"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="phone" placeholder="ნომერი"></input>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="პაროლი"></input>
                    </div>
                   <!--  <div class="form-group">
                        <div class="click_upload user pull-right">
                            <span class="help">ფაილი არ არის არჩეული.</span>
                            <button type="button" class="btn uploadbtn">
                                <i class="fa fa-film" aria-hidden="true"></i> ვიდეოს ატვირთვა
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div> -->
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="acceptterms"> 
                                <a href="#" data-toggle="modal" data-target="#termsModal">ვეთანხმები წესებს და პირობებს და კონფიდენციალურობის პოლიტიკას
                                </a>
                            </label>
                        </div> 
                    </div>
                    <a tabindex="-1" style="width: 100%; margin-bottom: 15px; font-size: 17px;" href="/facebook/login" class="btn btn-primary text-center"><i class="fa fa-facebook-official"></i> Facebook ავტორიზაცია</a>
                    <!-- <input type="file" name="user_video" class="user_video hidden"> -->
                    <div class="form-group">
                        <button class="btn authBtn tableCentered" type="submit" name="">რეგისტრაცია</button>
                    </div>
                </form>
                <form id="company_form" class="form_hide company hidden" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="iscompany" value="1">
                    <div class="form-group">
                        <input class="form-control" name="name" placeholder="კომპანიის სახელი"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="phone" placeholder="ნომერი"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="email" placeholder="ელ.ფოსტა"></input>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="პაროლი"></input>
                    </div>
                    <!-- <div class="form-group">
                        <div class="click_upload company pull-right">
                            <span class="help">ფაილი არ არის არჩეული.</span>
                            <button type="button" class="btn uploadbtn">
                                <i class="fa fa-photo" aria-hidden="true"></i> ლოგოს ატვირთვა
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div> -->
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="acceptterms">
                                <a href="#" data-toggle="modal" data-target="#termsModal">ვეთანხმები წესებს და პირობებს და კონფიდენციალურობის პოლიტიკას
                                </a>
                            </label>
                        </div> 
                    </div>
                    <!-- <input type="file" name="comp_logo" class="comp_logo hidden"> -->
                    <div class="form-group">
                        <button class="btn authBtn tableCentered" type="submit" name="">რეგისტრაცია</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="login" class="pull-right">
            <div class="already_registered">
                უკვე ხართ <br>
                დარეგისტრირებული?
            </div>
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
                <a tabindex="-1" style="width: 100%; margin-bottom: 15px; font-size: 17px;" href="/facebook/login" class="btn btn-primary text-center"><i class="fa fa-facebook-official"></i> Facebook ავტორიზაცია</a>
                <div class="clearfix"></div>
                <div class="pull-right">
                    <button class="btn authBtn" type="submit" name="">შესვლა</button> 
                </div>
                <div class="pull-left">
                    <a href="/remember" class="forgot_password">პაროლის გახსენება</a>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>


<!-- MODALS -->
    <div id="termsModal" class="modal fade loginModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title text-center">
                წესები და პირობები
            </h3>
          </div>
          <div class="modal-body">
            @include('partials.texts.terms')  
          </div>
        </div>
      </div>
    </div>
<!-- MODALS -->
@stop

@section('js')
    <script type="text/javascript">
        $(function(){
            $('.switchbtn').click(function(){
                $('.switchbtn').removeClass('active');
                $(this).addClass('active');
                $('.form_hide').fadeOut().addClass('hidden');
                if($(this).hasClass('user')){
                    $('.forms .user').removeClass('hidden').fadeIn();
                }
                if($(this).hasClass('company')){
                    $('.forms .company').removeClass('hidden').fadeIn();
                }   
            });

            $('.click_upload.user').click(function(){
                $(".user_video").click();
            });
            $('.comp_video').change(function(){
                $('.click_upload.user .help').html($('.user_video').val());
            });

            $('.click_upload.company').click(function(){
                $(".comp_logo").click();
            });
            $('.comp_video').change(function(){
                $('.click_upload.user .help').html($('.comp_logo').val());
            });
            function logErrors(data){
                $('.errors').html(data.message);
                $('.errors').show();
            }
            $("#user_form").submit(function(e){
                e.preventDefault();
                $('.errors').html('');
                $('.errors').hide();
                var postData = $('#user_form').serialize();
                $.post('/register', postData).fail(function(data){
                    logErrors(data.responseJSON);
                }).done(function(){
                    location.replace('/');
                });
            });
            $("#company_form").submit(function(e){
                e.preventDefault();
                $('.errors').html('');
                $('.errors').hide();
                var postData = $('#company_form').serialize();
                $.post('/register', postData).fail(function(data){
                    logErrors(data.responseJSON);
                }).done(function(){
                    location.replace('/');
                });
            });
        });
    </script>
@stop