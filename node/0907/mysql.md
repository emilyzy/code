#mysql
    select
        select * from tablename;
        select name from tablename;
        select name,age from tablename;
        select name as username from tablename; 起别名 
        [MAX MIN AVG COUNT SUM...]
        select MAX(age) from tablename;
        
        WHERE 对查询结果进行筛选
            1 0
            键=值
            键 > >= < <= 值
            条件一 and 条件二 ...
        order by对于查询结果进行排序
            order by age
            order by age desc
        limit 截取
            limit 0,3 从第0条开始 取3条
        WHERE-->ORDER BY-->LIMIT
        
    delect
        delect from tablename where id=1;
    update
        update tablename set set age=10 where id=1;
    insert 
        insert into tablename (name,age,sex) values ('xiaoming',10,'man')
        insert into tablename (name,age,sex) values ('xiaoming',10,'man'),('xiaoming',10,'man')