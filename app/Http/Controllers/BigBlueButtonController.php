<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\Utils\BigBlueButtonClass;
use DB;

class BigBlueButtonController extends Controller
{ 
	private $meetingID = 208;
	private $meetingName="fifth  Meeting";
	private $attendee_password="123";
	private $moderator_password="321";
	private $duration =60;
	private $urlLogout ="http://localhost/bigbluebutton/meeting/list";
	private $isRecordingTrue=1;	
	
	public function __construct(){
		$this -> meetingID = BigBlueButtonClass :: Uuid($this->meetingID);
	}
	 public function getMeetings(){

			$response = BigBlueButtonClass::getMeetings();
			echo $response -> getMessageKey().'<br>';
			echo $response -> getMessage();
			print "<pre>";
			//print_r($response);

			if ($response->getReturnCode() == 'SUCCESS') {
				foreach ($response->getRawXml()->meetings->meeting as $meeting) {
					print_r($meeting);
					// process all meeting
				}
			}		 			
		 
	 } 	
	public function listMeeting(){
		 return view('bbb.list_meeting');
	 }	 
	public function addMeeting(){
		 return view('bbb.create_meeting');
	 }
	public function createMeeting(){
		if($_POST){
			$this -> meetingName =  Request::get('meetingName');
			$this -> attendee_password =  Request::get('attendee_password');
			$this -> moderator_password =  Request::get('moderator_password');
			$this -> duration =  Request::get('duration');
			$nextID = DB::table("meetings")->max("id")+1;
		 	$this -> meetingID = BigBlueButtonClass :: Uuid($nextID);
			
			DB::table('meetings')->insert(
    			['meetingID' => $this -> meetingID,
				 'meetingName' => $this -> meetingName,
				 'attendee_password' => $this -> attendee_password,
				 'moderator_password' => $this -> moderator_password,
				 'duration' => $this -> duration,
				 'urlLogout' => $this -> urlLogout,
				 'isRecordingTrue' => $this -> isRecordingTrue,
				 'recordID'=>''
				]
			);
			
			$param['meetingID'] 			= $this -> meetingID;
			$param['meetingName']			= $this -> meetingName;
			$param['attendee_password']		= $this -> attendee_password;
			$param['moderator_password']	= $this -> moderator_password;
			$param['duration'] 				= $this -> duration;
			$param['urlLogout'] 			= $this -> urlLogout;
			$param['isRecordingTrue']		= $this -> isRecordingTrue;		
			$response = BigBlueButtonClass :: createMeeting($param);
			if ($response->getReturnCode() == 'SUCCESS') {
				return redirect('/meeting/list')->with('status', "Meeting Created Successfully");
			}else{
				    return redirect('/meeting/add')->with('status', $response -> getMessage());
				
			}
			
		}
		
			
			
			
			
	 }
	 public function joinMeeting($name,$password,$meetingID){
			
			$param['meetingID'] = $meetingID;
			$param['name']		= $name;
			$param['password']	= $password;		 
			$url = BigBlueButtonClass ::  joinMeeting($param);
		 return redirect($url);
		 	header("Location:".$url);
			//echo $url;	
			
		
	 }
	 public function closeMeeting($password,$meetingID){
			$param['meetingID'] 			= $meetingID;
			$param['moderator_password']	= $password;		 
			$response = BigBlueButtonClass :: closeMeeting($param);
		 	return redirect('/meeting/list')->with('status', $response -> getMessage());
			echo $response -> getReturnCode().'<br>';
			echo $response -> getMessageKey().'<br>';
			echo $response -> getMessage().'<br>';
			print "<pre>";
			print_r($response);
			
		 
	 }
	 public function getMeetingInfo($password,$meetingID){
		 
			$param['meetingID'] 			= $meetingID;
			$param['moderator_password']	= $password;		 
			$response = BigBlueButtonClass :: getMeetingInfo($param);		
			//echo $response -> getReturnCode().'<br>';
			//echo $response -> getMessageKey().'<br>';
			//echo $response -> getMessage().'<br>';
		 echo "Meeting Information Response from BBB server";
			print "<pre>";
			print_r($response);
			
			if ($response->getReturnCode() == 'FAILED') {
				// meeting not found or already closed
				
			} else {
				print "<pre>";
				//print_r($response);
				// process $response->getRawXml();
			}		 
	 }
	 public function getRecordings(){
			$param['meetingID'] 			= $this -> meetingID;
			$response = BigBlueButtonClass :: getRecordings($param);		
			//echo $response -> getReturnCode().'<br>';
			//echo $response -> getMessageKey().'<br>';
			//echo $response -> getMessage().'<br>';	
		 	if ($response->getReturnCode() == 'SUCCESS') {
				return view('bbb.list_recordings',array("response"=>$response));
			 }else{
				echo "Recordings not found";
				
			}
			 
	 }
	 public function deleteRecordings($recordId){
			$param['recordingID'] 			= $recordId;
			$response = BigBlueButtonClass ::  deleteRecordings($param);					
			//echo $response -> getReturnCode().'<br>';
			//echo $response -> getMessageKey().'<br>';
			//echo $response -> getMessage().'<br>';			
			//print "<pre>";
		 //print_r($response);
		// exit;
			if ($response->getReturnCode() == 'SUCCESS') {
				  //return redirect('/meeting/recordings');
				return redirect('/meeting/recordings')->with('status', $response -> getMessage());
				
				// recording deleted
			} else {
				// something wrong
			}		 
	 }
	 public function isMeetingRunning(){
		 	$param['meetingID'] = $this -> meetingID;
			$response = BigBlueButtonClass :: isMeetingRunning($param);			
			echo $response -> getReturnCode().'<br>';
			echo $response -> isRunning().'<br>';
			print "<pre>";	
			print_r($response);
			
	 }
	 
}
