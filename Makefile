start-composer:
	docker compose -f ./docker/docker-compose.yml build  --no-cache 
	docker compose -f ./docker/docker-compose.yml up -d 
start-composer-stream:
	docker compose -f ./docker/docker-compose.yml build --no-cache
	docker compose -f ./docker/docker-compose.yml up -d
	ffmpeg -re -i ./files/dev/videos/test_video.mp4  -c:v copy -c:a aac -ar 44100 -ac 1 -f flv rtmp://localhost/live/stream