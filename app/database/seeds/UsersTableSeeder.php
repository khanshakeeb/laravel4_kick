<?php



class UsersTableSeeder extends Seeder {

	public function run()
	{

        // Create the super user

        $user = Sentry::createUser(array(
            'email'     => 'john.doe@example.com',
            'password'  => 'test',
            'activated' => true,
            'permissions' => array('superuser' => '1')
        ));


    }

}