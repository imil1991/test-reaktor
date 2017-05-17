Описание задачи

Представьте себе поисковую систему со следующим алгоритмом работы:

Входные данные:
поисковый запрос — "системный администратор в офис";
словарь переводов/синонимов для слов и словосочетаний (далее СЛОВАРЬ):

(системный, системный, system)
(администратор, админ.)
(системный администратор, сисадмин, systems administrator)


Нам нужно написать поисковый запрос для поиска всех подходящих документов по заданному запросу пользователя — "системный администратор в офис".

Он должен покрыть все варианты написания, в соответствии со СЛОВАРЕМ. Перестановкой слов мы пренебрегаем.

Доступные логические операторы:
"&" — И
 "|" — ИЛИ

Для группировки условий используются скобки, причем оператор ИЛИ имеет более высокий приоритет, чем оператор И.

Для нашего примера, при поиске "системный администратор в офис" оптимальным поисковым запросом будет:

(системный|системний|system & администратор|админ.)|сисадмин|"systems administrator" & офис

Уточнения:
словосочетания из словаря ищем в том же виде, как они записаны в словаре (берем в кавычки — "systems administrator");
при этом если словосочетание встречается в самом запросе (системный администратор), ищем его по словам;
слова из  одной буквы не ищем.


На картинке мы можем увидеть как полученный поисковый запрос разбивается на все возможные варианты, которыми можно описать пользовательский запрос используя наш словарь. И следовательно в итоге все найти интересующие его документы.


Что нужно сделать

Написать функцию, которая бы принимала пользовательский запрос (количество слов в запросе не ограничено) и максимальное количество слов в словосочетании (для которого будут искаться соответствия в словаре)  и возвращала оптимальный поисковый запрос.

Входные данные:

поисковые запросы:
"Системный администратор в офис"
"Системный администратор баз данных и безопасности"
"Системный администратор БД и безопасности"
СЛОВАРЬ:
(системный администратор, сисадмин, systems administrator, DevOps engineer)
(баз данных, БД, database)
(безопасности, безпеки, security)
(администратор баз данных, адміністратор БД, администратор БД, database administrator, dba)
(системный, system, системний)
Для тестирования функции можно дополнительно взять пользовательский запрос и словарь из описания задачи, и сравнить полученный результат.
