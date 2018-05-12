@if (count($errors))
  @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
      <li style="list-style-type:none;">{{ $error }}</li>
    </div>
  @endforeach
@endif
