# bookstore

Документация
    1. выполнить sql запрос с файла create_database для создания базы данных и таблиц.

Api
    1. api/authors
        - method: POST
        params
            - name(string)
    2. /api/genres
        - method: POST
        params
            - name(string)
    3. /api/books
        - method: POST
        params
            - title(string, max:30)
            - published_year(integer, max:4)
            - authors(array)
            - genres(array)
