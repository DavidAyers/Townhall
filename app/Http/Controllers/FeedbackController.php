<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Feedback;
use App\AttendeeFeedback;

class FeedbackController extends Controller
{
    //
    public function getFeedbacks($agendaId) {
        $attendeeId = $_GET["attendee_id"];
        $feedbacks = Feedback::where('agenda_id' , $agendaId)->get()->take(5);
        foreach($feedbacks as $feedback) {
            $attendeeFeedback = AttendeeFeedback::where("attendee_id" , $attendeeId)->where("feedback_id" , $feedback->id)->first();
            $feedback["answer"] = $attendeeFeedback != null ? $attendeeFeedback->answer : -1;
        }
        return Response::make($feedbacks, 200);
    }

    public function postAnswers(Request $request) {
        $data = $request->json()->all();

        $newAnswer1 = new AttendeeFeedback();
        $newAnswer1->attendee_id = $data["attendee_id"];
        $newAnswer1->feedback_id = $data["answers"]["q1_id"];
        $newAnswer1->answer = $data["answers"]["a1"];
        $newAnswer1->save();

        $newAnswer2 = new AttendeeFeedback();
        $newAnswer2->attendee_id = $data["attendee_id"];
        $newAnswer2->feedback_id = $data["answers"]["q2_id"];
        $newAnswer2->answer = $data["answers"]["a2"];
        $newAnswer2->save();

        $newAnswer3 = new AttendeeFeedback();
        $newAnswer3->attendee_id = $data["attendee_id"];
        $newAnswer3->feedback_id = $data["answers"]["q3_id"];
        $newAnswer3->answer = $data["answers"]["a3"];
        $newAnswer3->save();

        $newAnswer4 = new AttendeeFeedback();
        $newAnswer4->attendee_id = $data["attendee_id"];
        $newAnswer4->feedback_id = $data["answers"]["q4_id"];
        $newAnswer4->answer = $data["answers"]["a4"];
        $newAnswer4->save();

        $newAnswer5 = new AttendeeFeedback();
        $newAnswer5->attendee_id = $data["attendee_id"];
        $newAnswer5->feedback_id = $data["answers"]["q5_id"];
        $newAnswer5->answer = $data["answers"]["a5"];
        $newAnswer5->save();

        $result["status"] = "success";
        return Response::make($result, 200);
    }
}
