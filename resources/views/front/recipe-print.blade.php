<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>{{$gs->title}}</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/font-awesome/css/font-awesome.min.css')}}">
    

    <link rel="stylesheet" href="{{asset('assets/front/fonts/Linearicons/Linearicons/Font/demo-files/demo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/owl-carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/lightGallery-master/dist/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('assets/flashy/css/flashy.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/furniture.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
  </head>
  <body>
    


          <div class="container">
            <div class="row on-print-hid mt-50 mb-30 text-center">
              <div class="col-12">
                <div class="print-page-l">
                  <a href="{{route('front.recipe',$data->slug)}}" class="btn btn-outline-secondary">Go Back</a>
                  <a href="#" class="btn btn-info" onclick="printRecipe(event);"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</a>
                </div>
              </div>
            </div>

            <div class="row on-print-hid  mb-25 text-center">
              <div class="col-md-12">
                      <div class="input-group d-inline-flex plus-minus-div">
                          <span class="input-group-btn">
                              <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                               <i class="fa fa-minus" aria-hidden="true"></i>
                              </button>
                          </span>
                          <input type="text" style="height: auto;" id="quantity" name="quantity" class="form-control input-number" value="{{$data->serving}}" min="1" max="100">
                          <span class="input-group-btn">
                              <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                  <i class="fa fa-plus" aria-hidden="true"></i>
                              </button>
                              <span>&nbsp;&nbsp;People</span>
                          </span>

                      </div>
              </div>
            </div>




            <div class="row" id="RecipeToPrint">
              <div class="col-md-2"></div>
              <div class="col-md-8 ">
                <div class="ps-post">
                    <div class="recip-card">
                      <div class="r-card-content">
                        <div class="row">
                          <div class="col-md-8">
                            <h3>{{$data->name}}</h3>
                            
                            @if($data->author_check==2)
                              <a class="text-danger mb-10 ppn" href="{{$data->author_link}}">{{$data->author_name}}</a>
                              @else
                              <a class="text-danger mb-10 ppn" href="{{route('front.about')}}">{{$gs->name}}</a>
                              @endif
                            
                            <p class="sp-txt">
                              {{$data->summary}}
                                       </p>
                                       <p>
                                     <div class="form-group form-group__rating d-inline-flex ">

                               <div class="ps-product__rating">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>

                                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($data->id)}}%"></div>

                                    </div>
                                </div>
                              
                                          
                                          <span class="sp-txt"> &nbsp; {{App\Models\Rating::rating($data->id)}}
                                          Rating  </span>
                                      </div>                                                  

                                       </p>
                          </div>
                          <div class="col-md-4">
                            <div class="r-card-img">
                               <img class="img-thumbnail" src="{{$data->photo?asset('assets/images/recipe/'.$data->photo):asset('assets/images/noimage.png')}}" alt="">
                            </div>
                          </div>

                          <div class="r-card-spacer" style="height: 25px"></div>

                          

                          
                        </div>

                        <div class="r-card-spacer" style="height: 20px"></div>

                        <div class="r-card-sp-icon">
                          <div class="dec-line"></div>
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                          <div class="dec-line"></div>
                        </div>

                        <div class="row rc-r-1 mt-10">

                          <div class="col-6">
                            <p class="sp-txt "> PREP TIME</p>
                            <p class="sp-txt ">
                              {{$data->prep_days>0?
                                ''.$data->prep_days.' days':''}} 
                              {{$data->prep_hours>0?
                                ''.$data->prep_hours.' hours':''}} 
                              {{$data->prep_mins>0?
                                ''.$data->prep_mins.' mins':'0 mins'}}</p>
                          </div>
                          <div class="col-6">
                            <p class="sp-txt ">COOK TIME</p>
                            <p class="sp-txt ">
                              {{$data->cook_days>0?
                                ''.$data->prep_days.' days':''}} 
                              {{$data->cook_hours>0?
                                ''.$data->prep_hours.' hours':''}} 
                              {{$data->cook_mins>0?
                                ''.$data->prep_mins.' mins':'0 mins'}}
                            </p>
                          </div>                                                                                
                        </div>

                              <div class="row rc-r-2 mt-20 text-center">                                          
                          <div class="col-12 col-md-6  pr-0">
                            <div class="r-card-sp-icon">
                              <div class="dec-line "></div>
                                <span><i class="fa fa-fire"></i></span>
                              <div class="dec-line mob-rig-m"></div>
                            </div>
                                      <div class="d-inline-flex mt-15">
                                        <div class="rc-mr">
                                          <p class="sp-txt"> COURSE</p>
                                 
                                        <?php $arr=json_decode($data->recipes_id);?>
                                        @if($arr && $arr!='[]' )
                                          @foreach(App\Models\SubCategory::whereIn('id',$arr)->get() as $recipe)
                                           <p class="sp-txt ">
                                            {{$recipe->name}} 
                                            @if(App\Models\SubCategory::whereIn('id',$arr)->count()>1)
                                             ,
                                            @endif
                                           </p>
                                                
                                          @endforeach
                                      @else
                                          <p class="sp-txt ">not defined</p>
                                      @endif
                 
                                   
                                </div>
                                <div class="rc-mr">
                                          <p class="sp-txt ">CUISINE</p>
                              <?php $arr=json_decode($data->cuisines_id);?>
                                        @if($arr && $arr!='[]' )
                                          @foreach(App\Models\SubCategory::whereIn('id',$arr)->get() as $cuisine)
                                           <p class="sp-txt ">
                                            {{$cuisine->name}} 
                                            @if(App\Models\SubCategory::whereIn('id',$arr)->count()>1)
                                             ,
                                            @endif
                                           </p>
                                                
                                          @endforeach
                                      @else
                                      <p class="sp-txt ">not defined</p>
                                          
                                      @endif

                                  
                                </div>
                                      </div>
                          </div>
                          <div class="col-12 col-md-6  pl-0">
                              <div class="r-card-sp-icon">
                              <div class="dec-line mob-left-m"></div>
                                <span><i class="fa fa-cutlery"></i></span>
                              <div class="dec-line"></div>
                            </div>
                            <div class="d-inline-flex mt-15">
                                        <div class="rc-mr">
                                          <p class="sp-txt ">SERVINGS</p>
                                  <p class="sp-txt ">
                                    
                                    <span data-value="{{$data->serving}}" class="serve_people">{{$data->serving}}</span> 
                                    {{$data->serving_text?$data->serving_text:'People'}}</p>
                                </div>
                                <div class="rc-mr">
                                          <p class="sp-txt ">CALORIES</p>
                                  <p class="sp-txt ">{{$data->calories?
                                    ''.$data->calories.' kcal':'not defined'}} </p>
                                </div>
                                      </div>
                          </div> 
                        </div>                                     

                             @if(count($data->ingredients)>0)
                              <div class="rc-def rc-r-3 mt-20">
                                  <div class="r-card-sp-icon">
                                    <h3 class="ppn">INGREDIENTS</h3>
                            <div class="dec-line ml-15"></div>
                            
                            
                            </div>
                            <div class="rc-ul mt-20">
                                    <ul>
                                      @foreach($data->ingredients as $ingredient)
                                      <li>
                                        @if($ingredient->amount)
                                        <span class="adjustable-val" data-value="{{$ingredient->amount}}">
                                          {{$ingredient->amount}}</span>
                                        @endif
                                        <span>{{$ingredient->unit}} {{$ingredient->name}}</span>
                                      </li>
                                      @endforeach
                                                                                  
                                    </ul>
                                  </div>
                              </div>
                              @endif
                                      
                                      @if($data->instruction && $data->instruction!='<br>')
                              <div class="rc-def rc-r-4 mt-20">
                                  <div class="r-card-sp-icon">
                                    <h3 class="ppn">INSTRUCTIONS</h3>
                            <div class="dec-line mr-15 ml-15"></div>
                          </div>
                           <div class="in-content rc-ul mt-20">
                            <ul>
                              {!! $data->instruction !!}
                              
                            </ul>
                           </div>
                        </div>
                        @endif

                          @if($data->notes && $data->notes!='<br>')
                              <div class="rc-def rc-r-6 mt-20">
                                  <div class="r-card-sp-icon">
                                    <h3 class="ppn">NOTES</h3>
                            <div class="dec-line  ml-15"></div>
                          </div>
                           <div class="in-content rc-ul mt-20">
                            <ul>
                              {!! $data->notes !!}
                              
                            </ul>

                           </div>
                          </div>
                          @endif
                          @if($data->nutrition && $data->nutrition!='<br>')
                              <div class="rc-def rc-r-6 mt-20">
                                  <div class="r-card-sp-icon">
                                    <h3 class="ppn">NUTRITION</h3>
                            <div class="dec-line  ml-15"></div>
                          </div>
                           <div class="in-content rc-ul mt-20">
                                      <p class="sp-txt">
                                        {!! $data->nutrition !!}
                                      </p>


                           </div>
                        </div>
                        @endif
                        <div class="rc-r-7 mt-20">
                                <div class="r-card-sp-icon">
                            <div class="dec-line"></div>
                             <i class="fa fa-search" aria-hidden="true"></i>
                            <div class="dec-line"></div>
                          </div>
                          <div class="in-content mt-20">
                            <div class="text-center">
                              <p class="sp-txt ">KEYWORD</p>
                              <p class="sp-txt ">{{$data->keywords?$data->keywords:'not defined'}}</p>
                            </div>
                            <div class="rd-end-bg">
                              <span class="end-icon">
                                <i class="fa fa-instagram" style="font-size: 60px" aria-hidden="true"></i>
                              </span>
                              <span class="end-content">
                                <span>Tried this recipe?</span>
                                <span class="ppn">Mention 
                                  <a class="ppn" href="{{ App\Models\Socialsetting::find(1)->instagram }}">{{$gs->title}}</a>  or tag 
                                  <a class="ppn" href="{{ App\Models\Socialsetting::find(1)->instagram }}">#{{$gs->title}}!</a></span>
                              </span>
                            </div>
                          </div>
                        </div>

                        
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>





    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
{{--     <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div> --}}


    <script src="{{asset('assets/front/plugins/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/bootstrap4/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/slick/slick/slick.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/slick-animation.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/sticky-sidebar/dist/sticky-sidebar.min.js')}}"></script>
    <script src="{{asset('assets/front/plugins/jquery.slimscroll.min.js')}}"></script>

    <script src="{{ asset('assets/admin_assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>


    <script type="text/javascript">
      var mainurl = "{{url('/')}}";
      var gs      = {!! json_encode($gs) !!};
      

    </script>
    <!-- custom scripts-->
   @section('pagelevel_scripts')
   @show
   <script type="text/javascript" src="{{asset('assets/flashy/js/flashy.min.js')}}"></script>

    <script src="{{asset('assets/front/js/custom.js')}}"></script>
    <script src="{{asset('assets/front/js/main.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var quantitiy=0;
       $('.quantity-right-plus').click(function(e){
            
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
                quantity=quantity+1;
            // If is not undefined
                
                $('#quantity').val(quantity);

               var serve=parseInt($('.serve_people').attr('data-value'));


              $(".adjustable-val").each(function(){
               
               var orig_value=parseFloat($(this).attr('data-value'));
               var one=orig_value/serve;
               var adjust_val=one*quantity;
               $(this).text(adjust_val.toFixed(1));
               $('.serve_people').text(quantity);

             });
              
                // Increment
            
        });

         $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
          
                // Increment
                if(quantity>1){
                  quantity=quantity-1;
                $('#quantity').val(quantity);

                      var serve=parseInt($('.serve_people').attr('data-value'));


                        $(".adjustable-val").each(function(){
                         
                         var orig_value=parseFloat($(this).attr('data-value'));
                         var one=orig_value/serve;
                         var adjust_val=one*quantity;
                         $(this).text(adjust_val.toFixed(1));
                         $('.serve_people').text(quantity);
                         
                       });


                }
        });
        
    });
</script>

<script type="text/javascript">
    function printRecipe(event) 
  {
    event.preventDefault();
    $('.on-print-hid').hide();
    window.print();
    $('.on-print-hid').show();

    // var RecipeToPrint=document.getElementById('RecipeToPrint');

    // var newWin=window.open('','Print-Window');

    // // newWin.document.open();

    // newWin.document.write('<html><body onload="window.print()">'+RecipeToPrint.innerHTML+'</body></html>');

    // newWin.document.close();

    // setTimeout(function(){newWin.close();},10);
   // var divToPrint=document.getElementById("RecipeToPrint");
   // newWin= window.open("");
   // newWin.document.write(divToPrint.outerHTML);
   // newWin.print();
   // newWin.close();


  }
</script>


  </body>
</html>