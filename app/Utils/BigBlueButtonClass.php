<?php
namespace App\Utils;

use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\DeleteRecordingsParameters;
use BigBlueButton\Parameters\IsMeetingRunningParameters;
//
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class BigBlueButtonClass 
{
	
	 public static function getMeetings(){
			$bbb = new BigBlueButton();
			$response = $bbb->getMeetings();
			return $response;

	 } 	
	 public static function createMeeting($param=array()){
			$meetingID = $param['meetingID'];
			$meetingName=$param['meetingName'];
			$attendee_password= $param['attendee_password'];
			$moderator_password= $param['moderator_password'];
			$duration = $param['duration'];
			$urlLogout = $param['urlLogout'];
			$isRecordingTrue= $param['isRecordingTrue'];		
			$bbb = new BigBlueButton();			
			
			$createMeetingParams = new CreateMeetingParameters($meetingID, $meetingName);
			$createMeetingParams->setAttendeePassword($attendee_password);
			$createMeetingParams->setModeratorPassword($moderator_password);
			$createMeetingParams->setDuration($duration);
			$createMeetingParams->setLogoutUrl($urlLogout);
			$createMeetingParams->setWelcomeMessage("Welcome Message Here!");
			$createMeetingParams->setVoiceBridge("12345");
			
			if ($isRecordingTrue) {

				$createMeetingParams->setRecord(true);
				$createMeetingParams->setAllowStartStopRecording(true);
				$createMeetingParams->setAutoStartRecording(true);
			}
			//print "<pre>";
			//print_r($createMeetingParams);
			//exit;
			$response = $bbb->createMeeting($createMeetingParams);
			return $response;
			
	 }
	 public static function joinMeeting($param=array()){
			$meetingID 	= $param['meetingID'];
			$name		= $param['name'];
			$password	= $param['password'];
			$bbb = new BigBlueButton();
			$joinMeetingParams = new JoinMeetingParameters($meetingID, $name, $password); // $moderator_password for moderator
			$joinMeetingParams->setRedirect(true);
			$url = $bbb->getJoinMeetingURL($joinMeetingParams);
			return $url;	
	 }
	 public static function closeMeeting($param=array()){
			$meetingID 			= $param['meetingID'];
			$moderator_password	= $param['moderator_password'] ;
			$bbb = new BigBlueButton();
			$endMeetingParams = new EndMeetingParameters($meetingID, $moderator_password);
			$response = $bbb->endMeeting($endMeetingParams);	
			return $response;
		 
	 }
	 public static function getMeetingInfo($param=array()){
			$meetingID 			= $param['meetingID'];
			$moderator_password	= $param['moderator_password'] ;
			$bbb = new BigBlueButton();
			$getMeetingInfoParams = new GetMeetingInfoParameters($meetingID, '', $moderator_password);
			$response = $bbb->getMeetingInfo($getMeetingInfoParams);
			return $response;		 
	 }
	 public static function getRecordings($param=array()){
			$meetingID 			= $param['meetingID'];
			//$meetingID 			= 'df2ad546-a4f0-51ac-b38c-88216742e553';
			$recordingParams = new GetRecordingsParameters();
			//$recordingParams->setMeetingId($meetingID);
			//$recordingParams ->setRecordId('fd51abbd107aa99ae7e38231c3ff57b31522911a-1503934326175');
			$bbb = new BigBlueButton();
			$response = $bbb->getRecordings($recordingParams);
			return $response;
	 }
	 public static function deleteRecordings($param=array()){
			$recordingID = $param['recordingID'];
			$deleteRecordingsParams= new DeleteRecordingsParameters($recordingID); // get from "Get Recordings"
			$bbb = new BigBlueButton();
			$response = $bbb->deleteRecordings($deleteRecordingsParams);
			return $response;
			
	 }
	 public static function isMeetingRunning($param=array()){
		 	$meetingID = $param['meetingID'];
			$bbb = new BigBlueButton();
			$isMeetingRunningParams= new IsMeetingRunningParameters($meetingID); 
			$response = $bbb->isMeetingRunning($isMeetingRunningParams);
			return $response;
	 }
	 
	 public static function Uuid($string=''){
		$uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, $string);
		return $uuid5->toString();		
	 }
	 
}
