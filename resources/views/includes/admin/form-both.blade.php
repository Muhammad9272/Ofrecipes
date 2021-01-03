      <div class="alert alert-success validation" style="display: none;">
      <button type="button" class="close alert-close"><span>×</span></button>
            <p class="text-left"></p> 
      </div>
      <div class="alert alert-danger validation" style="display: none;">
      <button type="button" class="close alert-close"><span>×</span></button>
            <ul class="text-left">
              
            </ul>
      </div>

    @if (session('status'))
      <div class="alert alert-success validation">
      <button type="button" class="close alert-close"><span>×</span></button>
            <p class="text-left">{{ session('status') }}</p> 
      </div>
    @endif
    @if (session('cache'))
      <div class="alert alert-success validation">
      <button type="button" class="close alert-close"><span>×</span></button>
            <p class="text-left">{{ session('cache') }}</p> 
      </div>
    @endif