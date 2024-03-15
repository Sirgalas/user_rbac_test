<?php

declare(strict_types=1);

namespace Command;


use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UserRbacFramework\DB\AbstractDao;

#[AsCommand(name: 'migration')]
class InitMigration extends Command
{
    public function __construct(
        private readonly AbstractDao $abstractDao,
        ?string $name = null)
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sqls = [
        'CREATE TABLE IF NOT EXISTS  users_app (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
        );',
        'CREATE TABLE IF NOT EXISTS  groups_app (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        );',
        'CREATE TABLE IF NOT EXISTS roles_app (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        );',
        'CREATE TABLE IF NOT EXISTS  user_groups (
            user_id INT UNSIGNED NOT NULL,
            group_id INT UNSIGNED NOT NULL,
            FOREIGN KEY (user_id) 
                REFERENCES users_app(id)
                ON DELETE CASCADE,
            FOREIGN KEY (group_id) 
                REFERENCES groups_app(id)
                ON DELETE CASCADE,
            PRIMARY KEY (user_id, group_id)            
        );',
        'CREATE TABLE IF NOT EXISTS  role_groups (
            role_id INT UNSIGNED NOT NULL,
            group_id INT UNSIGNED NOT NULL,
            FOREIGN KEY (role_id) 
                REFERENCES roles_app(id)
                ON DELETE CASCADE,
            FOREIGN KEY (group_id) 
                REFERENCES groups_app(id)
                ON DELETE CASCADE,
            PRIMARY KEY (role_id, group_id)            
        );',
        'CREATE UNIQUE INDEX idx_user_groups_user_id
            ON user_groups(user_id);',
        'CREATE UNIQUE INDEX idx_user_groups_group_id
            ON user_groups(group_id);',

        'CREATE UNIQUE INDEX idx_role_groups_role_id
            ON role_groups (role_id);',
        'CREATE UNIQUE INDEX idx_role_groups_group_id
            ON role_groups (group_id);',

        "INSERT INTO roles_app (name)
        VALUES 
            ('send_messages'),
            ('service_api'),
            ('debug');"
        ];
        foreach ($sqls as $sql) {
            $this->abstractDao->execute($sql);
        }
        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new migration int.')
        ;
    }

}