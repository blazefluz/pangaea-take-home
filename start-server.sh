# node ./subscribers

curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:3001/"}' http://localhost:8000/subscribe/topic2
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:3002/"}' http://localhost:8000/subscribe/topic2
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:3003/"}' http://localhost:8000/subscribe/topic2
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:3004/"}' http://localhost:8000/subscribe/topic2
curl -X POST -H "Content-Type: application/json" -d '{"message": "hello"}' http://localhost:8000/publish/topic2
