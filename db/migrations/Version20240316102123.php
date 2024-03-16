<?php declare(strict_types=1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240316102123 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql(
            'CREATE TABLE IF NOT EXISTS  users_app (
                    id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
                    name VARCHAR(255) NOT NULL, 
                    PRIMARY KEY(id)) 
                DEFAULT CHARACTER SET utf8 
                COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
        'CREATE TABLE  IF NOT EXISTS   groups_app (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, 
                PRIMARY KEY(id)) 
            DEFAULT CHARACTER SET utf8 
            COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('
            CREATE TABLE IF NOT EXISTS roles_app (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, 
                PRIMARY KEY(id)) 
            DEFAULT CHARACTER SET utf8 
            COLLATE `utf8_unicode_ci` ENGINE = InnoDB');

        $this->addSql('
                CREATE TABLE IF NOT EXISTS user_groups (
                    user_id INT UNSIGNED NOT NULL, 
                    group_id INT UNSIGNED NOT NULL, 
                    UNIQUE INDEX idx_user_groups_group_id_user_id (group_id,user_id), 
                    FOREIGN KEY (user_id) 
                        REFERENCES users_app(id)
                        ON DELETE CASCADE
                        ON UPDATE RESTRICT,
                    FOREIGN KEY (group_id) 
                        REFERENCES groups_app(id)
                        ON DELETE CASCADE
                        ON UPDATE RESTRICT,
                    PRIMARY KEY(user_id, group_id))
                DEFAULT CHARACTER SET utf8 
                COLLATE `utf8_unicode_ci` ENGINE = InnoDB ');

        $this->addSql('
            CREATE TABLE IF NOT EXISTS role_groups (
                role_id INT UNSIGNED NOT NULL, 
                group_id INT UNSIGNED NOT NULL, 
                is_blocked BOOLEAN DEFAULT false,
                UNIQUE INDEX idx_role_groups_group_id_role_id (group_id,role_id),
                FOREIGN KEY (role_id) 
                    REFERENCES roles_app(id)
                    ON DELETE CASCADE
                    ON UPDATE RESTRICT,
                FOREIGN KEY (group_id) 
                    REFERENCES groups_app(id)
                    ON DELETE CASCADE
                    ON UPDATE RESTRICT,
                PRIMARY KEY(role_id, group_id)) 
                DEFAULT CHARACTER SET utf8 
                COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE users_app');
        $this->addSql('DROP TABLE groups_app');
        $this->addSql('DROP TABLE roles_app');
        $this->addSql('DROP TABLE role_groups');
        $this->addSql('DROP TABLE user_groups');
    }
}
