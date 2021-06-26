<?php

namespace App\Http\Controllers;

use App\Events\PublishTopic;
use Illuminate\Http\Request;
use App\Services\NotificationServices;

use App\Models\Topics;

class NotificationController extends Controller
{
    protected $notificationservice;

    /**
     * Undocumented function
     *
     * @param NotificationServices $notificationservice
     */
    public function __construct(NotificationServices $notificationservice)
    {
        $this->notificationservice = $notificationservice;
    }

    /**
     * publish a topic
     *
     * @param Request $request
     * @return void
    */

    public function publish_topic(Request $request, $topic)
    {
        $subscribers = $this->notificationservice->get_subscriptions_by_topic($topic);
        
        if($subscribers->count() > 0) {

            Topics::create([
                'topic' => $request->topic,
                'data' => $request->data,
                'isPublished' => $request->isPublished == true ? 1 : 0,
    
            ]);

            event(new PublishTopic($subscribers, $request->all()));

            return response()->json([
                'message' => 'message has been published succesfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'This topic has no subcribers',
            ], 422);
        }
    }


    public function subscribe_to_topic(Request $request, $topic)
    {
       
        $this->validate($request, [
            'url' => 'required|url',
        ]);
        
        $subscription = $this->notificationservice->create_subscription($request->url, $topic);
        
        // dd($subscription);
        if($subscription["success"]){
            return response()->json([
                'topic' => $topic,
                'url' => $subscription['url'],
            ], 200);
        }

        return response()->json([
            $subscription,
        ], 422);
    }
}
