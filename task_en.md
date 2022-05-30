## Test
The result of programming should be a repository with laravel 5.6 and commit history
#### (1). Create two models: Category and Product with the following fields:

##### Category:
>id (int)
title (string length min: 3, max 12)
eId (int|null)

##### Product:
>id (int)
categories (link: ManyToMany)
title (string length min: 3, max 12)
price (float range min: 0, max 200)
eId (int|null)

*eId - arbitrary id from any other system

##### 2. Implement a CRUD controller and service for the Product entity

The logic of adding, deleting should be moved to the service, these methods should also be used in task #3.

##### 3. Implement a console command that reads the two Json files below and adds/updates records to the database:

###### categories.json:
`[`   
`{"eId": 1, "title": "Category 1"},`   
`{ "eId": 2,"title": "Category 2"},`   
`{ "eId": 2,"title": "Category 33333333"}`   
`]`

###### products.json
`[`   
`{"eId": 1, "title": "Product 1", "price": 101.01, "categoriesEId": [1,2]},`   
`{"eId": 2, "title": "Product 2", "price": 199.01, "categoryEId": [2,3]},`   
`{"eId": 3, "title": "Product 33333333", "price": 999.01, "categoryEId": [3,1]}`   
`]`

* *take into account data validation*

##### 4. Create a subscriber/listener for adding/changing product.

When updating/adding product data, a subscriber or listener must send a message to the email specified in the parameter (arbitrary name) in the .env file