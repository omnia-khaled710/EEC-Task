# Pharmarcy management



## Installation

Use the package manager [composer](https://getcomposer.org/) to install packages.

```bash
php composer install
```




How to run the project: 

create database named EEC-Task

```bash

php artisan migrate

php artisan serve


```

## Scripts

Find top 5 cheapest selling pharmacies for specific product
```bash
PHP artisan products:search-cheapest 22

```

run seeders

```bash
php artisan db seed
```
## License

[MIT](https://choosealicense.com/licenses/mit/)
