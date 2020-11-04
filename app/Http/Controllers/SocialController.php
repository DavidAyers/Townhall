<?php

namespace App\Http\Controllers;

use App\Social;
use App\Comment;
use App\SocialAttendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Attendee;

class SocialController extends Controller
{
    //
    public function getSocials() {
        $socials = Social::orderBy('created_at' , 'DESC')->paginate(10);
        foreach($socials as $social) {
            $social["attendee"] = Attendee::find($social["attendee_id"]);
            $social["comments"] = Comment::where("social_id" , $social->id)->count();
            $social["likes"] = SocialAttendee::where("social_id" , $social->id)->count();
        }
        return Response::make($socials, 200);
    }

    public function getSocial($socialId) {
        $social = Social::find($socialId);
        return Response::make($social, 200);
    }

    public function getComments($socialId) {
        $comments = Comment::where('social_id', $socialId)->orderBy('created_at' , 'DESC')->paginate(10);
                
        foreach($comments as $comment) {
            $comment["attendee"] = Attendee::find($comment["attendee_id"]);
        }
        return Response::make($comments, 200);
    }

    public function postNewComment() {
        $comment = new Comment();
        $comment->social_id = $_POST['social_id'];
        $comment->attendee_id = $_POST['attendee_id'];
        $comment->text = $_POST['text'];
        
        $comment->save();

        $comment["attendee"] = Attendee::find($comment["attendee_id"]);
        return Response::make($comment, 200);
    }

    public function postNewSocial(Request $request) {
        $attendeeId      = $_POST['attendee_id'];
        $text            = isset($_POST['text']) ? $_POST['text'] : "";

        $newSocial = new Social();
        $newSocial->attendee_id = $attendeeId;
        $newSocial->text = $text;
        $newSocial->image = "";
        $newSocial->save();

        if($request->hasFile('image')){
            $file = $request->file('image');

            $image_name = $this->quickRandom().time().'.png';
            $newSocial = Social::find($newSocial->id);
            $newSocial->image = "uploads/avatar/social/".$image_name;
            $newSocial->save();
            $destination_path = public_path('/uploads/uploads/avatar/social');
            chmod($destination_path,0777);
            $file->move($destination_path,$image_name);            
        }
        $newSocial["attendee"] = Attendee::find($newSocial["attendee_id"]);
        $newSocial["comments"] = Comment::where("social_id" , $newSocial->id)->count();
        $newSocial["likes"] = SocialAttendee::where("social_id" , $newSocial->id)->count();
        // $result["status"] = 1;
        // $result["message"] = "Successfully Posted!";
        // $result["data"] = $social;
        return Response::make($newSocial, 200);
    }

    

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function postLikeSocial() {
        $attendeeId      = $_POST['attendee_id'];
        $socialId        = $_POST['social_id'];

        $newSocialAttendee = new SocialAttendee();
        $newSocialAttendee->attendee_id = $attendeeId;
        $newSocialAttendee->social_id = $socialId;
        $newSocialAttendee->save();

        $social = Social::find($socialId);
        $social->likes++;
        $social->save();

        // $result["status"] = 1;
        // $result["message"] = "Successfully Liked!";
        // $result["data"] = $social->likes;
        return Response::make($social, 200);
    }

    public function postDisLikeSocial() {
        $attendeeId      = $_POST['attendee_id'];
        $socialId        = $_POST['social_id'];
        
        SocialAttendee::where('attendee_id' , $attendeeId)->where('social_id', $socialId)->delete();

        $social = Social::find($socialId);
        $social->likes--;
        $social->save();

        // $result["status"] = 1;
        // $result["message"] = "Successfully DisLiked!";
        // $result["data"] = $social->likes;
        return Response::make($social, 200);
    }

    public function getLikeStatus() {
        $attendeeId      = $_GET['attendee_id'];
        $socialId        = $_GET['social_id'];

        
       $result["status"] = SocialAttendee::where('attendee_id' , $attendeeId)->where('social_id', $socialId)->first() == null ? "no" : "yes";
        return Response::make($result, 200);
    }
}
