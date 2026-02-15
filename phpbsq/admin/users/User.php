<?php

require 'MysqlAdapter.php';
require 'database_config.php';

/**
 * User Class
 */
class User extends MysqlAdapter
{
    /**
     * @var string
     */
    private $_table = 'users';

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        // Add from the database configuration file
        global $config;
        parent::__construct($config);
    }

    /**
     * Get All Users
     * * @return array
     */
    public function getUsers()
    {
        $this->select($this->_table);
        return $this->fetchAll();
    }

    /**
     * Get a specific user
     * * @param int $user_id
     * @return array
     */
    public function getUser($user_id)
    {
        $this->select($this->_table, " `id` = " . (int) $user_id);
        return $this->fetch();
    }

    /**
     * Add New User
     * * @param array $data
     * @return int
     */
    public function addUser($data)
    {
        return $this->insert($this->_table, $data);
    }

    /**
     * Update User
     * * @param array $data
     * @param int $user_id
     * @return int
     */
    public function updateUser($data, $user_id)
    {
        return $this->update($this->_table, $data, " `id` = " . (int) $user_id);
    }

    /**
     * Delete User
     * * @param int $user_id
     * @return int
     */
    public function deleteUser($user_id)
    {
        return $this->delete($this->_table, " `id` = " . (int) $user_id);
    }


    /**
     * Search for users
     * @param string $keyword
     * @return array
     */
    public function searchUsers($keyword)
    {
        $this->select($this->_table, " `name` LIKE " . $this->quoteValue('%' . $keyword . '%') . " OR `email` LIKE " . $this->quoteValue('%' . $keyword . '%'));
        return $this->fetchAll();
    }

    /**
     * Authenticate User
     * @param string $email
     * @param string $password
     * @return array|false
     */
    public function login($email, $password)
    {
        $where = "`email` = " . $this->quoteValue($email) . " AND `password` = " . $this->quoteValue(sha1($password));
        $this->select($this->_table, $where, '*', '', 1);
        return $this->fetch();
    }
}