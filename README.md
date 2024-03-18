что бы развсернуть

> выполнить deploy.sh
> для работы использовать колекцию postman

можно было бы сделать через такой запрос получить роли
`
SELECT r.name AS role_name, IF(max(is_blocked) is null, 'НЕТ', max(is_blocked)) as bloket
    FROM roles_app r
    LEFT JOIN role_groups rg ON r.id = rg.role_id
    LEFT JOIN groups_app g ON rg.group_id = g.id
    LEFT JOIN user_groups ug ON g.id = ug.group_id AND ug.user_id = 1
group by role_name;`
но у меня ещё несколько тестовых заданий
