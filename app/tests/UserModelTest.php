<?php
ob_start();


class UserModelTest extends TestCase
{
    /**
     * Test login
     */
    public function testLogin()
    {
        $bool = false;
        $user = new \DoctorFinder\Model\User();
        $login = $user->authenticate(array('email' => 'john.doe@example.com', 'password' => 'test',), false);
        $this->assertTrue($user->isLogin(), "Login successfully");
    }
}
