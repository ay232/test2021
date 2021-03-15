<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

### Установка
#### Выполните последовательно необходимые команды.  
###### Для клонирования проекта из репозитория:
`git clone http://github.com/ay232/test2021/ .`
###### Установите зависимости
`composer install`  
###### Настройте среду и данные
`php artisan storage:link`  
`php artisan migrate:fresh --seed`

#### Импорт файлов *.json согласно ТЗ
`php artisan read:json`  
##### Пути файлов  
* *storage/app/public/categories.json*
* *storage/app/public/products.json*  

Файлы специально были добавлены в репозиторий.

### Тестирование задания
Задание выполнено исходя из обращения к функциям программы через API.  
Для удобства использования создана и опубликована коллекция postman.  
URL: https://www.getpostman.com/collections/5b8d58e98f07075ccbcd  
Для тестирования сайта ему был назначен адрес: http://test2021.loc.
### Документация на API
#### Доступ к API
**Bearer** *UYqKfnFVEddt6ZunWpQPN7lYu1eZK37F0a0l5RCfBxeJMMsstTjBQYEO7mE4*
#### Product
##### Список продуктов
**GET**: test2021.loc/api/product/  
**Ответ**: JSON  
##### Карточка продукта
**GET**: test2021.loc/api/product/{id}  
**Ответ**: JSON  
##### Создать новый продукт
**POST**: test2021.loc/api/product/  
**Ответ**: JSON  
##### Изменить продукт
**PUT**: test2021.loc/api/product/{id}  
**Ответ**: JSON  
##### Удалить продукт
**DELETE**: test2021.loc/api/product/{id}  
**Ответ**: JSON
####### Примечания к работе
* V1 в адрес API не добавлялось, т.к. других версий не предполагается.
* Контроллер Category не создавался, т.к. его не было в ТЗ
* Вероятно в ТЗ имеется опечатка в файле categories.json - 
там в json данных слово CategoriesEId и CategoryEId написаны по разному.
Возможно, это фишка для валидации или ошибка, однако **в консольной команде
сделана обработка обоих возможных значений** как валидных.

#### Спасибо за внимание!
##### Буду признателен за code review на ay232@ya.ru
