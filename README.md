# Тестовое задание для ПТМК

## О проекте

Консольное приложение написано на нативном PHP 8.2, composer использовался только для управления импортированием локальных файлов через autoload, сторонних библиотек и фреймворков использовано не было.<br>
Приложение было сделано с использованием XAMPP (Apache + MySQL).

## Реализованный функционал

* Создание таблицы с полями представляющими ФИО, дату рождения, пол.
* Создание записи в формате: "ФИО ДатаРождения Пол".
* Вывод всех строк с уникальным значением ФИО + дата, сортировка по ФИО, вывод в формате: "ФИО ДатаРождения Пол КоличествоЛет".
* Заполнение автоматически 1000000 строк, а затем 100 строк по определённым критериям.
* Выборка из таблицы по критерию: пол мужской, ФИО начинается с "F".
* Создание составного индекса по столбцам: ФИО, пол.

## Установка зависимостей

```shell
composer install
```

## Запуск приложения

Запуск производится из директории public по различным командам, пример команды:

```shell
php start.php 1
```

## Ускорение запроса

Индексирование баз данных — это техника, повышающая скорость и эффективность запросов к базе данных. Она создаёт отдельную структуру данных, сопоставляющую значения в одном или нескольких столбцах таблицы с соответствующими местоположениями на физическом накопителе, что позволяет базе данных быстро находить строки по конкретному запросу без необходимости сканирования всей таблицы.<br>

Было произведено создание составного индекса (индексирование) по столбцам ФИО и пола для ускорения запросов на чтение.

### Замер времени запроса на чтение до индексирования

<div align="center">
  <img src="https://github.com/flametong/ptmk-test-assignment-solution/assets/32167273/6d31cc88-22f9-4e5e-b2f3-9e7a281c1d63" alt="Before indexing">
</div>

### Замер времени запроса на чтение после индексирования

<div align="center">
  <img src="https://github.com/flametong/ptmk-test-assignment-solution/assets/32167273/70e07490-8387-431c-905e-ab4472043bad" alt="Before indexing">
</div>

## Скриншоты приложения

<div align="center">
  <img src="https://github.com/flametong/ptmk-test-assignment-solution/assets/32167273/a0cf9e6e-ebba-42e3-870d-4aeeb241bce0" alt="Before indexing">
</div>

<div align="center">
  <img src="https://github.com/flametong/ptmk-test-assignment-solution/assets/32167273/940a1f4a-579a-4a57-9353-c4b4abe7add6" alt="Before indexing">
</div>

<div align="center">
  <img src="https://github.com/flametong/ptmk-test-assignment-solution/assets/32167273/a79de4d4-74ef-4922-afe3-96926ddc73e3" alt="Before indexing">
</div>

<div align="center">
  <img src="https://github.com/flametong/ptmk-test-assignment-solution/assets/32167273/9aecee02-5e8b-418a-bace-0c7d07d21451" alt="Before indexing">
</div>

