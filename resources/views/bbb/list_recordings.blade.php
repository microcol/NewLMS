@extends('bbb.layouts_default')
@section('content')    

  <h1>Recordings List</h1>
 
	<table class="table table-bordered">
		<thead>
		  <tr>
				<th>ID</th>
				  <th>Meeting ID</th>
				  <th>Name</th>
				  <th>Status</th>
				  <th>Start Date</th>
				  <th>End Date</th>
				  <th>Play</th>
		      	  <th>Delete</th>
		  </tr>
		</thead>
		<tbody>
		<?php
			$i=1;
				foreach ($response->getRawXml()->recordings->recording as $recording) {
						 $start_timestamp = (float)($recording->startTime); 
						$end_timestamp = (float)($recording->endTime); 
					?>
						<tr >
						  <td><?php echo $i;?></php></td>
						  <td><?php echo $recording->meetingID;?></td>
						  <td><?php echo $recording->name;?></td>
						  <td><?php echo $recording->state;?></td>
						  <td><?php echo date('Y-m-d h:i:s',$start_timestamp/1000);?></td>
						  <td><?php echo date('Y-m-d h:i:s',$end_timestamp/1000);?></td>
						  <td><a href="<?php echo $recording->playback->format->url;?>" target="_blank">PlayBack</a></td>
						  <td><a href="{{ url('/meeting/recording/') }}/<?php echo $recording->recordID;?>" >delete</a></td>
						</tr>		
			<?php						
					$i++;

					// process all recording
				}
			?>
		 
		</tbody>
	  </table>     
@endsection	  
