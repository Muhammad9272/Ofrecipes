              @include('includes.admin.form-error') 
              <form id="geniusformdata" action="{{route('admin-recipe-highlight',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                <div class="modal-body"> 
                  Highlight Recipe as:
                      <div class="mt-checkbox-list">
                          <label class="mt-checkbox mt-checkbox-outline">
                              <input type="checkbox" name="is_featured" {{$data->is_featured?'checked':''}} value="1"> Featured Recipe
                              <span></span>
                          </label>
                          <label class="mt-checkbox mt-checkbox-outline">
                              <input type="checkbox" {{$data->is_trending?'checked':''}} name="is_trending" value="1"> Trending Recipe
                              <span></span>
                          </label>
                          
                      </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn green addProductSubmit-btn">Save changes</button>
                </div>
              </form>