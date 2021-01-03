                            @if(App\Models\Socialsetting::find(1)->f_status == 1)
                              
                                <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                             
                              @endif

                              @if(App\Models\Socialsetting::find(1)->g_status == 1)
                              
                                <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                              
                              @endif

                              @if(App\Models\Socialsetting::find(1)->t_status == 1)
                              
                                <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                              
                              @endif

                              @if(App\Models\Socialsetting::find(1)->l_status == 1)
                             
                                <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                              
                              @endif

                              @if(App\Models\Socialsetting::find(1)->d_status == 1)
                              
                                <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                             
                              @endif
                              @if(App\Models\Socialsetting::find(1)->i_status == 1)
                             
                                <a href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            
                              @endif
                              @if(App\Models\Socialsetting::find(1)->p_status == 1)                              
                                <a href="{{ App\Models\Socialsetting::find(1)->pinterest }}" class="pinterest" target="_blank">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                              @endif

                              @if(App\Models\Socialsetting::find(1)->y_status == 1)
                             
                                <a href="{{ App\Models\Socialsetting::find(1)->youtube }}" class="youtube" target="_blank">
                                    <i class="fa fa-youtube"></i>
                                </a>
                              
                              @endif                              
