# instalation
after cloning repository run
```shell
composer install
# after u connect db
yii.bat migrate #for windwos
yii migrate #for linux
```

# Usage:
## registration
```shell
curl --location 'http://localhost:8080/registration/register' \
--header 'Accept: application/json' \
--form 'name="test"' \
--form 'email="test@te1t.com"' \
--form 'password="password"' \
--form 'confirmPassword="password"' \
--form 'role="user"'
```
```shell
curl --location 'http://localhost:8080/auth/login' \
--header 'Accept: application/json' \
--form 'email="test@test.com"' \
--form 'password="password"'
```
## Get Profies with services
```shell
curl --location 'http://localhost:8080/profy' \
--header 'Authorization: Bearer token from login request'
```

## Book profy
```shell
curl --location 'http://localhost:8080/bookin/create' \
--header 'Authorization: Bearer token from login' \
--form 'service_id="1"' \
--form 'profy_id="1"' \
--form 'date="2022-12-21"' \
--form 'time="15:00:00"' \
--form 'till="18:00:00"'
```
note: date, time, till must be in format Y-m-d H:i:s

## Delete Booking
```shell
curl --location 'http://localhost:8080/bookin/delete' \
--header 'Authorization: Bearer token from login' \
--form 'id="3"'
```


## Get all the services
```shell
curl --location 'http://localhost:8080/services/index' \
--form 'id="3"'
```



# profy services
## Get all the services
```shell
curl --location 'http://localhost:8080/profy/index' \
--header 'Authorization: Bearer token from login'
```

## profy services create
```shell
curl --location 'http://localhost:8080/profy/create' \
--header 'Authorization: Bearer token from login' \
--form 'service_id="3"'
```

## profy delete service
```shell
curl --location 'http://localhost:8080/profy/delete' \
--header 'Authorization: Bearer  token from login' \
--form 'service_id="1"'
```