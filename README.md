# FakeSQLArticle
FakeSQLArticle - generate fake articles and save it in your database
# How use this class?
To use this class you must:
1. In the class: class.Database.php set the data to connect to the database
2. Include a file: class.FakeSQLArticle.php to your project
3. Create new class copy and call objects:

```php
$faker = new FakeSQLArticle;

$faker->tableName('articles')
	  ->titleColumn('title')
	  ->articleColumn('content')
	  ->authorColumn('author')
      ->dateColumn('date_time')
      ->numberOfArticle(20)
      ->lengthSingleArticle(20)
      ->executeFaker();
      //->clearFaker();
```
# Methods description

1. `tableName()` - Your table name
2. `titleColumn()` - Your title column name
3. `articleColumn()` - Your article column name
4. `authorColumn()` - Your author column name
5. `dateColumn()` - Your date column name
6. `numberOfArticle()` - Number of article.
7. `lengthSingleArticle()` - Number of characters single article
8. `executeFaker()` - Add fake article. It`s execute method.
9. `clearFaker()` - Clear your table with fake article 