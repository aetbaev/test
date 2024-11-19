
## Для установки необходимо:

```
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

В .env заполнить:
```
CHATAPP_EMAIL=
CHATAPP_PASSWORD=
CHATAPP_APPID=
CHATAPP_LICENSE_ID=
```

Для теста достаточно использовать:
```
DB_CONNECTION=sqlite
```


```
php artisan queue:work
php artisan schedule:work
php artisan serve
```

### Тестовый пользователь:
```
test@test.ru
test
```

### Что не успел сделать:
* при добавлении рассылки RequestForm и валидации
* обработка исключений
* страница просмотра списка телефонов рассылки и их статусы, но в сихронном статус присваивается
* нет выбора messengerType 
* ...и всё что было в "Необязательно", а так в принципе нет проблем их выполнить
