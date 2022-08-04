@echo on
set YII_HOME=%~dp0
php.exe -f %YII_HOME%vendor\friendsofphp\php-cs-fixer\php-cs-fixer fix --config=%YII_HOME%php-cs-fixer.php --verbose