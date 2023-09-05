export PROJECT_NAME=notification_app
export IMAGE_NAME=notification_app
export PROJECT_TITLE="Notification App Demo Version"
export PROJECT_HTTP_PORT=3006

.SILENT:info

info:
	echo ""
	echo "\033[92m${PROJECT_TITLE}\033[0m"
	echo ""
	echo "	- \033[35mHTTP:\033[0m : http://localhost:${PROJECT_HTTP_PORT}"
	echo ""

upd:
	docker-compose -p=${PROJECT_NAME} up -d
	make info

down:
	docker-compose -p=${PROJECT_NAME} down

build:
	docker-compose -p=${PROJECT_NAME} build --no-cache

bash:
	docker exec -it ${IMAGE_NAME} /bin/bash

logs:
	docker-compose -p=${PROJECT_NAME} logs -t --follow --tail=500