<!-- alert message start -->
@if (session('success'))
<div class="alert alert-dismissible fade show alert-success">
  <div class="alert-heading">
    Success!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="alert-body">
    {{ session('success') }}
  </div>
</div>
@endif @if (session('info'))
<div class="alert alert-dismissible fade show alert-info">
  <div class="alert-heading">
    Information!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="alert-body">
    {{ session('info') }}
  </div>
</div>
@endif @if (session('warning'))
<div class="alert alert-dismissible fade show alert-warning">
  <div class="alert-heading">
    Warning!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="alert-body">
    {{ session('warning') }}
  </div>
</div>
@endif @if (session('error'))
<div class="alert alert-dismissible fade show alert-danger">
  <div class="alert-heading">
    Error!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="alert-body">
    {{ session('error') }}
  </div>
</div>
@endif
<!-- alert message end -->
