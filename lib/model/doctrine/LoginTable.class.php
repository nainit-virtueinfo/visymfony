<?php


class LoginTable extends Doctrine_Table
{
    public static function getInstance()
    {
		return Doctrine_Core::getTable('Login');
    }

	public function getUser($userName ='',$password='')
	{
		  $q = Doctrine_Query::create()
			->select('l.username,l.password')
			->from('Login l')
			->where('l.username = ?',$userName)
			->andWhere('l.password = ?',$password);
		 return $q->fetchArray();
	}

	public function getAllUser()
	{ 
		  $q = Doctrine_Query::create()
			->select('L.*')
			->from('Login L');
		return $q;
	}

	public function updatePass($email ='',$password ='')
	{
		  $q = Doctrine_Query::create()
			->update('Login l')
			->set('password','?',$password)
			->where('l.email = ?',$email);
		  return  $q->execute();
	}
}