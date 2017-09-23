@extends('bbb.layouts_default')
@section('content')    
                  
                   <h1>Create New Meeting</h1>
<form method="post" action="{{ url('/meeting/create') }}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="inputsm">Meeting Name</label>
    <input class="form-control input-sm" id="meetingName" name="meetingName" type="text" required>
  </div>
   <div class="form-group">
    <label for="inputdefault">Attendee Password</label>
    <input class="form-control" id="attendee_password" name="attendee_password" type="text" required>
  </div>
  <div class="form-group">
    <label for="inputlg">Moderator Password</label>
    <input class="form-control input-sm" id="moderator_password" name="moderator_password" type="text" required>
  </div>
  <div class="form-group">
    <label for="inputlg">Duration</label>
    <input class="form-control input-sm" id="duration" name="duration" type="number" required>
  </div>
  
  <div class="form-group">
      <input type="submit" class="btn btn-info" value="Create Meeting">

  </div>
</form> 
                   
@endsection	    