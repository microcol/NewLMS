@extends('bbb.layouts_default')
@section('content')    

  <h1>Meetings List</h1>
 
	<table class="table table-bordered">
		<thead>
		  <tr>
			<th>Meeting ID </th>
			<th>Meeting Name</th>
			<th>Attendee Password</th>
			<th>Moderator Password</th>
			<th>Duration</th>
			<th>Info</th>
			<th>Moderator</th>
			<th>Attendee</th>
			<th>Close</th>
		  </tr>
		</thead>
		<tbody>
	  <?php
			$meetingsList = DB::table("meetings")->get();
			$i=1;
			foreach($meetingsList as $meeting){
		?>
		  <tr>
			<td><a href="{{ url('/meeting/info/') }}/<?php echo $meeting->moderator_password;?>/<?php echo $meeting->meetingID;?>"  target="_blank" ><?php echo $meeting -> meetingID;?></a></td>
			<td><?php echo $meeting -> meetingName;?></td>
			<td><?php echo $meeting -> moderator_password;?></td>
			<td><?php echo $meeting -> attendee_password;?></td>
			<td><?php echo $meeting -> duration;?> Min</td>
			<td><a href="{{ url('/meeting/info/') }}/<?php echo $meeting->moderator_password;?>/<?php echo $meeting->meetingID;?>"  target="_blank" >info</a></td>			
			<td><a href="{{ url('/meeting/join/') }}/Moderator <?php echo $i;?>/<?php echo $meeting->moderator_password;?>/<?php echo $meeting->meetingID;?>"  target="_blank" >join</a></td>
			<td><a href="{{ url('/meeting/join/') }}/Demo <?php echo $i;?>/<?php echo $meeting->attendee_password;?>/<?php echo $meeting->meetingID;?>" target="_blank" >join</a></td>
			  <td><a href="{{ url('/meeting/close/') }}/<?php echo $meeting->moderator_password;?>/<?php echo $meeting->meetingID;?>"  target="_blank" >close</a></td>
		  </tr>
		  <?php
			$i++;
			} ?>
		 
		</tbody>
	  </table>     
@endsection	  
