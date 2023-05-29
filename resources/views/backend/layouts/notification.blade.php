

@if(session("success"))
<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
  {{session("success")}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(session("error"))
<div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
  {{session("error")}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif