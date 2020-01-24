<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function redirect($role)
    {
        echo "<script>U bent ingelogd</script>";

        if ($role === 'ranger') {
            header('Location: /main/index');
        } else if ($role === 'admin' || $role === 'customer' || $role === 'organisation') {
            header('Location: /admin/map');
        }
    }

    public function authenticate()
    {
        $result = $this->model('User')->checkLogin($_POST['email'], $_POST['password']);



        switch ($result) {
            case 1:
                Login::redirect('ranger');
                break;

            case 2:
                Login::redirect('customer');
                break;

            case 3:
                Login::redirect('admin');
                break;

            case 4:
                Login::redirect('organisation');
                break;

            default:
                header('Location: /login');
        }
    }
}
