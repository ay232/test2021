<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

### Installation
#### Execute the required commands in sequence.
###### To clone a project from a repository:
`git clone http://github.com/ay232/test2021/ .`
###### Install dependencies
`composer install`
###### Set up environment and data
`php artisan storage:link`
`php artisan migrate:fresh --seed`

#### Import *.json files according to TOR
`php artisan read:json`
##### File paths
* *storage/app/public/categories.json*
* *storage/app/public/products.json*

The files were specifically added to the repository.

### Testing the job
The task was completed based on the call to the program functions via the API.
For ease of use, the postman collection has been created and published.
URL: https://www.getpostman.com/collections/5b8d58e98f07075ccbcd
To test the site, he was assigned the address: http://test2021.loc.
### API Documentation
#### API access
**Bearer** *UYqKfnFVEddt6ZunWpQPN7lYu1eZK37F0a0l5RCfBxeJMMsstTjBQYEO7mE4*
#### Product
##### Grocery list
**GET**: test2021.loc/api/product/
**Response**: JSON
##### Product card
**GET**: test2021.loc/api/product/{id}
**Response**: JSON
##### Create a new product
**POST**: test2021.loc/api/product/
**Response**: JSON
##### Change product
**PUT**: test2021.loc/api/product/{id}
**Response**: JSON
##### Delete product
**DELETE**: test2021.loc/api/product/{id}
**Response**: JSON
####### Job Notes
* V1 was not added to the API address, because no other versions are expected.
* The Category controller was not created because he was not in the TK
* There is probably a typo in the TOR in the categories.json file -
  there in the json data the words CategoriesEId and CategoryEId are written differently.
  Perhaps this is a validation feature or a bug, but ** in the console command
  both possible values** were treated as valid.

#### Thank you for your attention!
##### I would be grateful for a code review at ay232@ya.ru