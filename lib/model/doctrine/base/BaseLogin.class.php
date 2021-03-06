<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Login', 'doctrine');

/**
 * BaseLogin
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $username
 * @property string $password
 * 
 * @method integer   getId()         Returns the current record's "id" value
 * @method timestamp getCreatedAt()  Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()  Returns the current record's "updated_at" value
 * @method string    getFirstName()  Returns the current record's "first_name" value
 * @method string    getLastName()   Returns the current record's "last_name" value
 * @method string    getEmail()      Returns the current record's "email" value
 * @method string    getUsername()   Returns the current record's "username" value
 * @method string    getPassword()   Returns the current record's "password" value
 * @method Login     setId()         Sets the current record's "id" value
 * @method Login     setCreatedAt()  Sets the current record's "created_at" value
 * @method Login     setUpdatedAt()  Sets the current record's "updated_at" value
 * @method Login     setFirstName()  Sets the current record's "first_name" value
 * @method Login     setLastName()   Sets the current record's "last_name" value
 * @method Login     setEmail()      Sets the current record's "email" value
 * @method Login     setUsername()   Sets the current record's "username" value
 * @method Login     setPassword()   Sets the current record's "password" value
 * 
 * @package    doctrine
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLogin extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('login');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('first_name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('last_name', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('email', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('username', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('password', 'string', 64, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 64,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}