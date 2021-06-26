<h1>Pangaea Take Home Assignment</h1>
## Summary
An HTTP notification system. A server (or set of servers) will keep track of  topics ->
subscribers where a topic is a string and a subscriber is an HTTP endpoint. When a message is published on a topic, it
should be forwarded to all subscriber endpoints.

## Usage
- ```run composer install```
- ```npm install```

- ```php artisan serve``` to start server
- ```node ./demoservers``` to start demo server
- ```./start-server.sh``` to run test

## Examples
- create a topic
   ```
       **url**
      http://localhost:8000/publish/biography
      
       **REQUEST BODY**
      {
        "msg": "Welcome to lagos",
        "name": "victor",
        "bookTitle": "The richest man in babylon"
      }
      ```
- create subscription
   ```
    **url**
    http://localhost:8000/subscribe/lagosGist
    
     **REQUEST BODY**
    {
      "url": "http://localhost:3001/"
    }
    ```
