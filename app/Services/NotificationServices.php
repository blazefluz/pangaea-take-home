<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


use App\Models\Subscription;

class NotificationServices
{

    /**
    * get by subscribers by topic
    *
    * @param String $topic
    *
    * @return collection
    *
    */

    public function get_subscriptions_by_topic($topic)
    {
        $subscibers = Subscription::select(["url", "topic"])->where("topic", $topic)->get();
        return $subscibers;

    }


    /**
     * create subscription 
     *
     * @param String $topic
     * @param String $url
     * @return array
     */
    public function create_subscription($url, $topic)
    {
        
        try{
            
            // check if subscriber exist 
            $findSubscriber = Subscription::where([ [ 'topic', $topic], [ 'url', $url ] ])->exists();
            
            if($findSubscriber){
                return [
                    'message' => 'You are currently subscribed to this topic. :)',
                    'success' => false
                ];
            }
            
            // create a new subscription 
            $subscribed = Subscription::create([
                'topic' => $topic,
                'url' => $url,
            ]);
          
            return [
                'url' => $subscribed->url,
                'message' => 'You subscribed to this topic successfully',
                'success' => true
            ];

        }catch(\Throwable $error){
            Log::error(
                "Ooops!! You are unable to create subscription at the moment",
                ["error" =>  $error->getMessage()]
            );

            return [
                'error' => 'Ooops!! You are unable to create subscription at the moment',
                'data' => $error->getMessage(),
                'success' => false
            ];
        }
    }


    
    /**
     * Notify subscriber 
     *
     * @param \App\Models\Subscription $subscription
     * @param object|array $payload
     *
     *
     */
    public function publish_message($subscription, $payload)
    {
       try {
        $data = [
            "topic" => $subscription->topic,
            "data"=> $payload
        ];

        $response = Http::post($subscription->url, $data );

        Log::error("Message successful", ["error" =>  $response->body()]);

       } catch (\Throwable $error) {

        Log::error("Ooops!!! we were unable to notify this subscriber", ["error" => $error->getMessage()]);

       }
    }
}