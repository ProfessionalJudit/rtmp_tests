start-compose:
	docker compose build --no-cache
	docker compose up -d
start-docker:
	docker build -t test_rmtp .
#	docker run -it --rm -d -p 8080:80 -p 1935:1935 --name test_rmtp test_rmtp
	docker run -it --rm -p 8090:80 -p 1935:1935 -p 8088:8088 --name test_rmtp -v ./files/nginx.conf:/etc/nginx/nginx.conf  \
	-v ./files/index.html:/usr/share/nginx/html/index.html  \
	-v ./files/rmtp:/etc/nginx/sites-available/rtmp -d test_rmtp 

#https://www.digitalocean.com/community/tutorials/how-to-set-up-a-video-streaming-server-using-nginx-rtmp-on-ubuntu-20-04